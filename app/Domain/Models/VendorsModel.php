<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

class VendorsModel extends BaseModel
{
    // Add a constructor that uses
    public function __construct(private PDOService $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Retrieves vendors with optional filtering.
     *
     * Supported filters:
     * - country: vendor country.
     * - founded_after: minimum founding year.
     * - founded_before: maximum founding year.
     * - keyboard_count_min: minimum number of keyboards produced.
     * - avg_price_min: minimum average keyboard price.
     * - avg_price_max: maximum average keyboard price.
     *
     *  Supported sorting:
     * - sort: field to sort by (name, founded_year, country, keyboard_count, avg_keyboard_price)
     * - order: sort direction (asc or desc), defaults to asc
     *
     * @param array $filters Associative array of filter parameters.
     * @return array Paginated result with meta and data.
     */
    public function getVendors(array $filters): array
    {
        // Join with keyboards to calculate aggregates
        $sql = "SELECT v.*,
                       COUNT(DISTINCT k.keyboard_id) as keyboard_count,
                       AVG(k.price) as avg_keyboard_price
                FROM vendors v
                LEFT JOIN keyboards k ON v.vendor_id = k.vendor_id
                WHERE 1=1";

        $pdo_values = [];

        // Filter by country
        if (!empty($filters["country"])) {
            $sql .= " AND v.country = :country";
            $pdo_values["country"] = $filters["country"];
        }

        // Filter by founded after year
        if (!empty($filters["founded_after"])) {
            $sql .= " AND v.founded_year >= :founded_after";
            $pdo_values["founded_after"] = $filters["founded_after"];
        }

        // Filter by founded before year
        if (!empty($filters["founded_before"])) {
            $sql .= " AND v.founded_year <= :founded_before";
            $pdo_values["founded_before"] = $filters["founded_before"];
        }

        // Group by vendor to calculate aggregates
        $sql .= " GROUP BY v.vendor_id";

        // Filter by keyboard count minimum (using HAVING for aggregates)
        if (!empty($filters["keyboard_count_min"])) {
            $sql .= " HAVING COUNT(DISTINCT k.keyboard_id) >= :keyboard_count_min";
            $pdo_values["keyboard_count_min"] = $filters["keyboard_count_min"];
        }

        // Filter by average keyboard price range
        if (!empty($filters["avg_price_min"])) {
            // Check if HAVING clause already exists
            if (empty($filters["keyboard_count_min"])) {
                $sql .= " HAVING AVG(k.price) >= :avg_price_min";
            } else {
                $sql .= " AND AVG(k.price) >= :avg_price_min";
            }
            $pdo_values["avg_price_min"] = $filters["avg_price_min"];
        }

        if (!empty($filters["avg_price_max"])) {
            // Check if HAVING clause already exists
            if (empty($filters["keyboard_count_min"]) && empty($filters["avg_price_min"])) {
                $sql .= " HAVING AVG(k.price) <= :avg_price_max";
            } else {
                $sql .= " AND AVG(k.price) <= :avg_price_max";
            }
            $pdo_values["avg_price_max"] = $filters["avg_price_max"];
        }

        // Determine sort field and order
        $allowed_sort_fields = ["name", "founded_year", "country", "keyboard_count", "avg_keyboard_price"];
        $sort_field = "v.name"; // Default sort field
        $sort_order = "ASC"; // Default sort order

        if (!empty($filters["sort"]) && in_array($filters["sort"], $allowed_sort_fields)) {
            // Map sort field to actual column
            if ($filters["sort"] === "keyboard_count") {
                $sort_field = "keyboard_count";
            } elseif ($filters["sort"] === "avg_keyboard_price") {
                $sort_field = "avg_keyboard_price";
            } else {
                $sort_field = "v." . $filters["sort"];
            }
        }

        // Validate sort order
        if (!empty($filters["order"]) && strtoupper($filters["order"]) === "DESC") {
            $sort_order = "DESC";
        }

        // Add ORDER BY clause
        $sql .= " ORDER BY {$sort_field} {$sort_order}";

        return $this->paginate($sql, $pdo_values);
    }

    /**
     * Retrieves a single vendor by ID.
     * @param int $vendor_id The vendor ID.
     * @return mixed The vendor data or false if not found.
     */
    function findVendorById(int $vendor_id): mixed
    {

        $sql = "SELECT * FROM vendors WHERE vendor_id = :vendor_id";
        $vendor = $this->fetchSingle(
            $sql,
            ["vendor_id" => $vendor_id]
        );
        return $vendor;
    }
}
