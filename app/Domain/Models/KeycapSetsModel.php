<?php

declare(strict_types=1);

namespace App\Domain\Models;

use App\Helpers\Core\PDOService;

/**
 * Model for managing keycap set resource.
 *
 * @author Ishi <lalinglabrador@gmail.com>
 */
class KeycapSetsModel extends BaseModel
{
    public function __construct(PDOService $pdo)
    {
        parent::__construct($pdo);
    }


    /**
     * Retrieves keycap sets compatible with a specific layout.
     * This is a sub-collection of the layout resource.
     *
     * @param int $layout_id The layout ID
     * @param array $filters Additional filter parameters
     * @return mixed Array with the layout, meta, and keycap_sets or false if layout not found.
     */
    public function getKeycapSetsByLayoutId (int $layout_id, array $filters) : mixed
    {
        //* STEP 1: Fetch the parent layout resource.
        $layout_sql = "SELECT * FROM layouts WHERE layout_id = :layout_id";
        $layout = $this->fetchSingle($layout_sql, ["layout_id" => $layout_id]);

        if ($layout === false) {
            return false;
        }

        //* STEP 2: Fetch the keycap sets sub-collection
        $sql = "SELECT ks.
                FROM keycap_sets ks
                INNER JOIN keycap_compatibility kc ON ks.keycap_id = kc.keycap_id
                WHERE kc.layout_id = :layout_id";

        $pdo_values = ["layout_id" => $layout_id];

        // Filter by material
        if (!empty($filters["material"])) {
            $sql .= " AND ks.material = :material";
            $pdo_values["material"] = $filters["profile"];
        }

        // Filter by profile
        if (!empty($filters["profile"])) {
            $sql .= " AND ks.profile = :profile";
            $pdo_value ["profile"] = $filters["profile"];
        }

        // Filter by price maximum
        if (!empty($filters["price_max"])) {
            $sql .= " AND ks.price <= :price_max";
            $pdo_values["price_max"] = $filters["price_max"];
        }

        // Filter by manufacturer
        if (!empty($filters["manufacturer"])) {
            $sql .= " AND ks.manufacturer = :manufacturer";
            $pdo_values["manufacturer"] = $filters["manufacturer"];
        }

        $keycap_sets = $this->paginate($sql, $pdo_values);

        $results = [
            "layout" => $layout,
            "meta" => $keycap_sets["meta"],
            "keycap_sets" => $keycap_sets["data"]
        ];

        return $results;
    }
}
