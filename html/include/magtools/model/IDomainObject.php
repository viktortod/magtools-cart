<?php
interface IDomainObject {
    function getAllElements();
    function getElement($id);
    function insert($id, $row);

    function update($id, $row);

    function getField($fieldName);
    function delete($id);
}