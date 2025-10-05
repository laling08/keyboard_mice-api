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

    public function getVendors(array $filters): array
    {
        // filters
        $pdo_values = [];
        $supported_filers = ["name", "year", "keyboard_count"];
        // Filter by name?
        $sql = "SELECT * FROM vendors WHERE 1";
        // if (
        //     isset($filters["name"]) &&
        //     !empty($filters["name"])
        //    )

        if (!empty($name_filter))
        {
            //! Do not forget to put space before the AND
            $sql .= " AND name LIKE CONCAT('%', :vendor_name, '%')";
            $pdo_values ["vendor_name"] = $filters["name"];
        }
        // return $this->fetchAll($sql);

        return $this->paginate($sql, $pdo_values); // call the method that has the metadata
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
