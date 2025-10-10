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

    public function getKeyboards (array $filters) : array 
    {
        $sql = "SELECT k.*, v.name as vendor_name, s.name as switch_name, l.bane as layout_name
                FROM keyboards k
                INNER JOIN vendors v ON k.vendor_id = v.vendor_id
                INNER JOIN switches s ON k.switch_id = s.switch_id
                INNER JOIN layouts l ON k.switch_id = l.layout_id
                WHERE 1=1"; // Trick to easily add AND conditions

        $pdo_values = [];

        // Filter by connectivity
        if (!empty($filters["switch_type"])) {
            $sql .= " AND s.type = :"
        }

    }

}
