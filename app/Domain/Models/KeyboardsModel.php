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
     * Retrieves keyboards with optional filtering
     *
     * @param array $filters Associative array of filter parameters
     * @return array Paginated result with meta and data.
     */
    public function getKeyboards (array $filters) : array
    {
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.name as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.switch_id = l.layout_id
                WHERE 1=1"; // Trick to easily add AND conditions

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

        // Filter by hot-swappable (boolean)
        if (isset($filters["hot_swappable"])) {
            $sql .= " AND k.hot_swappable = :hot_swappable";

            $pdo_values["hot_swappable"] = filter_var($filters["hot_swappable"], FILTER_VALIDATE_BOOLEAN) ? 1 : 0;
        }

        // Filter by weight maximum
        if (!empty($filters["weight_max"])) {
            $sql .= " AND k.weight = :weight_max";
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

        // Return paginated results
        return $this->paginate($sql, $pdo_values);

    }

    /**
     * Retrieves a single keyboard by ID
     * @param int $keyboard_id The keyboard ID
     * @return mixed The keyboard data or false if not found
     */
    public function findKeyboardById (int $keyboard_id) : mixed
    {
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.name as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.layout_id = l.layout_id
                WHERE k.keyboard_id = :keyboard_id";

        return $this->fetchSingle($sql, ["keyboard_id" => $keyboard_id]);
    }

}
