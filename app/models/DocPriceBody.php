<?php

namespace app\Models;

use vendor\Model;



class DocPriceBody extends Model
{
    protected $table = 'DocPriceBody';

    public function priceByDate($datetime)
    {
        $sql = "SELECT p.id, p.title, p.description, h.price, h.product_id, d.datetime FROM DocPriceBody h
RIGHT JOIN (
SELECT Max(id) as max_data_id FROM DocPriceBody h Where h.doc_id = (
SELECT d.id FROM DocPrice d WHERE d.datetime = :datetime) GROUP By h.product_id) AS hh ON h.id = hh.max_data_id
RIGHT JOIN DocPrice d ON d.id=h.doc_id
RIGHT JOIN Product p ON p.id=h.product_id
WHERE p.status != 0";

        $result = $this->_db->queryParam($sql,$datetime);

        return $result;
    }
}