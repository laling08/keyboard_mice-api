<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

/**
 * Model for managing keyboard resources
 *
 * @author Ishi <lalinglabrador@gmail.com>
 */
class KeyboardsModel extends BaseModel
{
    public function __construct(private PDOService $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Retrieves keyboards with optional filtering.
     * Supported sorting:
     * - sort: field to sort by (name, price, weight, release_date, vendor_name)
     * - order: sort direction (asc or desc), defaults to asc
     *
     * @param array $filters Associative array of filter parameters
     * @return array Paginated result with meta and data.
     */
    public function getKeyboards(array $filters): array
    {
        $sql = "SELECT k.*,
                       v.name as vendor_name,
                       s.name as switch_name,
                       s.type as switch_type,
                       l.name as layout_name,
                       p.firmware as pcb_firmware
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.layout_id = l.layout_id
                LEFT JOIN pcbs p ON k.keyboard_id = p.keyboard_id
                WHERE 1=1";

        $pdo_values = [];

        // Filter by switch type
        if (!empty($filters["switch_type"])) {
            $sql .= " AND s.type = :switch_type";
            $pdo_values["switch_type"] = $filters["switch_type"];
        }

        // Filter by connectivity
        if (!empty($filters["connectivity"])) {
            $sql .= " AND k.connectivity = :connectivity";
            $pdo_values["connectivity"] = $filters["connectivity"];
        }

        // Filter by hot_swappable
        if (isset($filters["hot_swappable"])) {
            $sql .= " AND k.hot_swappable = :hot_swappable";
            $pdo_values["hot_swappable"] = filter_var($filters["hot_swappable"], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        }

        // Filter by weight maximum
        if (!empty($filters["weight_max"])) {
            $sql .= " AND k.weight <= :weight_max";
            $pdo_values["weight_max"] = $filters["weight_max"];
        }

        // Filter by release date range
        if (!empty($filters["release_date_after"])) {
            $sql .= " AND k.release_date >= :release_date_after";
            $pdo_values["release_date_after"] = $filters["release_date_after"];
        }

        if (!empty($filters["release_date_before"])) {
            $sql .= " AND k.release_date <= :release_date_before";
            $pdo_values["release_date_before"] = $filters["release_date_before"];
        }

        // Filter by PCB firmware type
        if (!empty($filters["pcb_firmware"])) {
            $sql .= " AND p.firmware = :pcb_firmware";
            $pdo_values["pcb_firmware"] = $filters["pcb_firmware"];
        }

        // Determine sort field and order
        $allowed_sort_fields = ["name", "price", "weight", "release_date", "vendor_name"];
        $sort_field = "k.name"; // Default sort field
        $sort_order = "ASC"; // Default sort order

        if (!empty($filters["sort"]) && in_array($filters["sort"], $allowed_sort_fields)) {
            // Map sort field to actual column
            if ($filters["sort"] === "vendor_name") {
                $sort_field = "v.name";
            } else {
                $sort_field = "k." . $filters["sort"];
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
     * Retrieves a single keyboard by ID
     * @param int $keyboard_id The keyboard ID
     * @return mixed The keyboard data or false if not found
     */
    public function findKeyboardById(int $keyboard_id): mixed
    {
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.name as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.layout_id = l.layout_id
                WHERE k.keyboard_id = :keyboard_id";

        return $this->fetchSingle($sql, ["keyboard_id" => $keyboard_id]);
    }

   /**
    * Retrieves keyboards that use a specific layout.
    * This is a sub-collection of the layout resource.
    *
    * @param int $layout_id The layout ID
    * @param array $filters Additional Filters
    * @return mixed Array with layout, meta, and keyboards or false if layout not found
    */
   public function getKeyboardsByLayoutId(int $layout_id, array $filters): mixed
    {
        // STEP 1: Fetch the parent layout resource
        $layout_sql = "SELECT * FROM layouts WHERE layout_id = :layout_id";
        $layout = $this->fetchSingle($layout_sql, ["layout_id" => $layout_id]);

        if ($layout === false) {
            return false;
        }

        // STEP 2: Fetch the keyboards sub-collection
        $sql = "SELECT k.*,
                       v.name as vendor_name,
                       s.name as switch_name,
                       s.type as switch_type
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                WHERE k.layout_id = :layout_id";

        $pdo_values = ["layout_id" => $layout_id];

        // Apply additional filters
        if (!empty($filters["switch_type"])) {
            $sql .= " AND s.type = :switch_type";
            $pdo_values["switch_type"] = $filters["switch_type"];
        }

        if (!empty($filters["price_min"])) {
            $sql .= " AND k.price >= :price_min";
            $pdo_values["price_min"] = $filters["price_min"];
        }

        if (!empty($filters["price_max"])) {
            $sql .= " AND k.price <= :price_max";
            $pdo_values["price_max"] = $filters["price_max"];
        }

        if (!empty($filters["connectivity"])) {
            $sql .= " AND k.connectivity = :connectivity";
            $pdo_values["connectivity"] = $filters["connectivity"];
        }

        $keyboards = $this->paginate($sql, $pdo_values);

        // STEP 3: Structure the response
        $results = [
            "layout" => $layout,
            "meta" => $keyboards["meta"],
            "keyboards" => $keyboards["data"]
        ];
        return $results;
    }
}
