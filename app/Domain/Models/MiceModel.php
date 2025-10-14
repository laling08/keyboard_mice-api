<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

/**
 * Model for managing mouse resources
 *
 * @author Ishi <lalinglabrador@gmail.com>
 */
class MiceModel extends BaseModel
{
    public function __construct(private PDOService $pdo)
    {
        parent::__construct($pdo);
    }

    /**
     * Retrieves mice with optional filtering
     * @param array $filters Associative array of filter parameters
     * @return array Paginated result with meta and data
     */
    public function getMice(array $filters): array
    {
        $sql = "SELECT m.*,
                       v.name as vendor_name,
                       ms.name as sensor_name,
                       COUNT(DISTINCT mb.button_id) as button_count,
                       AVG(mr.rating) as avg_rating
                FROM mice m
                INNER JOIN vendors v ON m.vendor_id = v.vendor_id
                INNER JOIN mouse_sensor ms ON m.sensor_id = ms.sensor_id
                LEFT JOIN mouse_buttons mb ON m.mouse_id = mb.mouse_id
                LEFT JOIN mouse_reviews mr ON m.mouse_id = mr.mouse_id
                WHERE 1=1";

        $pdo_values = [];

        // Filter by polling rate
        if (!empty($filters["polling_rate"])) {
            $sql .= " AND m.polling_rate = :polling_rate";
            $pdo_values["polling_rate"] = $filters["polling_rate"];
        }

        // Filter by connection type
        if (!empty($filters["connection"])) {
            $sql .= " AND m.connection = :connection";
            $pdo_values["connection"] = $filters["connection"];
        }

        // Filter by weight range
        if (!empty($filters["weight_min"])) {
            $sql .= " AND m.weight >= :weight_min";
            $pdo_values["weight_min"] = $filters["weight_min"];
        }

        if (!empty($filters["weight_max"])) {
            $sql .= " AND m.weight <= :weight_max";
            $pdo_values["weight_max"] = $filters["weight_max"];
        }

        // Filter by price range
        if (!empty($filters["price_min"])) {
            $sql .= " AND m.price <= :price_min";
            $pdo_values["price_min"] = $filters["price_min"];
        }

        if (!empty($filters["price_max"])) {
            $sql .= " AND m.price >= :price_max";
            $pdo_values["price_max"] = $filters["price_max"];
        }

        // Group by mouse to calculate aggregates
        $sql .= " GROUP BY m.mouse_id";

        // Filter by button count minimum
        if (!empty($filters["button_count_min"])) {
            $sql .= " HAVING COUNT(DISTINCT mb.button_id) >= :button_count_min";
            $pdo_values["button_count_min"] = $filters["button_count_min"];
        }

        // Filter by average rating minimum
        if (!empty($filters["avg_rating_min"])) {
            // Handle case where there might be no HAVING clause yet
            if (empty($filters["button_count_min"])) {
                $sql .= " HAVING AVG(mr.rating) >= :avg_rating_min";
            } else {
                $sql .= " AND AVG(mr.rating) >= :avg_rating_min";
            }
            $pdo_values["avg_rating_min"] = $filters["avg_rating_min"];
        }

        return $this->paginate($sql, $pdo_values);
    }

    /**
     * Retrieves buttons for a specific mouse
     * This is a sub-collection of the mouse resource
     *
     * @param int $mouse_id The mouse ID
     * @param array $filters Additional filter parameters
     * @return mixed Array with mouse, meta, and buttons or false if mouse not found
     */
    public function getButtonsByMouseId(int $mouse_id, array $filters): mixed
    {
        // STEP 1: Fetch the parent mouse resource
        $mouse_sql = "SELECT m.*, v.name as vendor_name, ms.name as sensor_name
                      FROM mice m
                      INNER JOIN vendors v ON m.vendor_id = v.vendor_id
                      INNER JOIN mouse_sensors ms ON m.sensor_id = ms.sensor_id
                      WHERE m.mouse_id = :mouse_id";
        $mouse = $this->fetchSingle($mouse_sql, ["mouse_id" => $mouse_id]);

        if ($mouse === false) {
            return false;
        }

        // STEP 2: Fetch the buttons sub-collection
        $sql = "SELECT mb.*
                FROM mouse_buttons mb
                WHERE mb.mouse_id = :mouse_id";

        $pdo_values = ["mouse_id" => $mouse_id];

        // Filter by programmable
        if (isset($filters["programmable"])) {
            $sql .= " AND mb.programmable = :programmable";
            $pdo_values["programmable"] = filter_var($filters["programmable"], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        }

        // Filter by exact button name
        if (!empty($filters["name"])) {
            $sql .= " AND mb.name = :name";
            $pdo_values["name"] = $filters["name"];
        }

        // Filter by partial name match
        if (!empty($filters["name_contains"])) {
            $sql .= " AND mb.name LIKE :name_contains";
            $pdo_values["name_contains"] = "%" . $filters["name_contains"] . "%";
        }

        $buttons = $this->paginate($sql, $pdo_values);

        // STEP 3: Structure the response
        $results = [
            "mouse" => $mouse,
            "meta" => $buttons["meta"],
            "buttons" => $buttons["data"]
        ];

        return $results;
    }
}
