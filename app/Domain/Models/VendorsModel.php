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
     * Supported Filters:
     * - country: vendor country
     * - founded-after: minimum founding year
     * - founded-before: maximum founding year
     * - keyboard_count_min: minimum number of keyboards produced
     * - avg_price_min: minimum average keyboard price
     * - avg_price_max: maximum average keyboard price
     * @param array $filters Associative array of filter parameters
     * @return array Paginated result with meta and data
     */
    public function getVendors(array $filters): array
    {
        //* Join with keyboards to calculate aggregates.
        $sql = "SELECT v.*,
                        COUNT(DISTINCT k.keyboard_id) as keyboard_count,
                        AVG(k.price) as avg_keyboard_price
                FROM vendors v
                LEFT JOIN keyboards k ON v.vendor_id = k.vendor.id
                WHERE 1=1";
        $pdo_values = [];

        //* Filter by country
        if (!empty($filters["country"])) {
            $sql .= " AND v.country = :country";
            $$pdo_values["country"] = $filters["country"];
        }

        //* Filter by founded year after
        if (!empty($filters["founded_after"])) {
            $sql .= " AND v.founded_year >= :founded_after";
            $pdo_values["founded_year"] = $filters["founded_after"];
        }

        //* Filter by founded year before
        if (!empty($filters["founded_before"])) {
            $sql .= " AND v.founded_year <= :founded_before";
            $pdo_values["founded_year"] = $filters["founded_before"];
        }

        //* Group by vendor to calculate aggregates
        $sql .= " GROUP BY v.vender_id";

        //* Filter by average keyboard price range
        if (!empty($filters["avg_price_min"])) {
            if (empty($filters["keyboard_count_min"])) {
                $sql .= " HAVING AVG(k.price) >= :avg_price_min";
            } else {
                $sql .= " AND AVG(k.price) >= :avg_price_min";
            }
            $pdo_values["avg_price_min"] = $filters["avg_price_min"];
        }

        if (!empty($filters["avg_price_max"])) {
            if (empty($filters ["keyboard_count_min"]) && empty($filters["avg_price_min"])) {
                $sql .= " HAVING AVG(k.price) <= :avg_price_max";
            } else {
                $sql .= " AND AVG(k.price) <= :avg_price_max";
            }
            $pdo_values["avg_price_max"] = $filters["avg_price_max"];
        }

        return $this->paginate($sql, $pdo_values);
    }

    function findVendorById(int $vendor_id) : mixed {

        $sql = "SELECT * FROM vendors WHERE vendor_id = :vendor_id";
        $vendor = $this->fetchSingle(
            $sql,
            ["vendor_id" => $vendor_id]
        );
        return $vendor;
    }
}
