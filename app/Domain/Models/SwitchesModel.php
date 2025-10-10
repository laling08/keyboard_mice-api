<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

/**
 * Model for managing switch resources
 *
 * @author Ishi <lalinglabrador@email.com>
 */
class SwitchesModel extends BaseModel
{
    public function __construct(private PDOService $pdo)
    {
        parent::__construct($pdo);
    }

    public function getSwitchesByVendorId(int $vendor_id, array $filters): mixed
    {
        //* STEP 1: Fetch the parent vendor resource
        $vendor_sql = "SELECT * FROM vendors WHERE vendor_id = :vendor_id";
        $vendor = $this->fetchSingle($vendor_sql, ["vendor_id" => $vendor_id]);

        if ($vendor === false) {
            return false;
        }

        //* STEP 2: Fetch the switches sub-collection
        $sql = "SELECT s.*, v.name as vendor_name
                FROM switches s
                INNER JOIN vendors v ON s.vendor_id = v.vendor_id
                WHERE s.vendor_id = :vendor_id";

        $pdo_values = ["vendor_id" => $vendor_id];

        //* Filter by switch type
        if (!empty($filters["type"])) {
            $sql .= " AND s.type = :type";
            $pdo_values["type"] = $filters["type"];
        }

        //* Filter by actuation force range
        if (!empty($filters["actuation_force_min"])) {
            $sql .= " AND s.actuation_force >= :actuation_force_min";
            $pdo_values["actuation_force_min"] = $filters["actuation_force_min"];
        }

        if (!empty($filters["actuation_force_max"])) {
            $sql .= " AND s.actuation_force <= :actuation_force_max";
            $pdo_values["actuation_force_max"] = $filters["actuation_force_max"];
        }

        //* Filter by travel distance range
        if (!empty($filters["travel_distance_min"])) {
            $sql .= " AND s.total_travel >= :travel_distance_min";
            $pdo_values["travel_distance_min"] = $filters["travel_distance_min"];
        }

        if (!empty($filters["travel_distance_max"])) {
            $sql .= " AND s.total_travel <= :travel_distance_max";
            $pdo_values["travel_distance_max"] = $filters["travel_distance_max"];
        }

        //* Filter by lifespan minimum
        if (!empty($filters["lifespan_min"])) {
            $sql .= " AND s.lifespan_million >= :lifespan_min";
            $pdo_values["lifespan_min"] = $filters["lifespan_min"];
        }

        //* Filter by release date range
        if (!empty($filters["release_date_after"])) {
            $sql .= " AND s.release_date >= :release_date_after";
            $pdo_values["release_date_after"] = $filters["release_date_after"];
        }

        if (!empty($filters["release_date_before"])) {
            $sql .= " AND s.release_date <= :release_date_before";
            $pdo_values["release_date_before"] = $filters["release_date_before"];
        }

        $switches = $this->paginate($sql, $pdo_values);

        //* STEP 3: Structure the response following the sub-collection pattern
        $results = [
            "vendor" => $vendor,
            "meta" => $switches["meta"],
            "switches" => $switches["data"]
        ];

        return $results;
    }
}
