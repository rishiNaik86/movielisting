<?php

function getDbConnect()
{
    $connection = new mysqli('localhost', 'root', '', 'agency_assignment');
    return $connection;
}

function getPaginationData($connection, $sql, $perPageCount, $pageNumber)
{
    if ($result = mysqli_query($connection, $sql)) 
    {
        $rowCount = mysqli_num_rows($result);
        mysqli_free_result($result);
    }
    $resultSet['pagesCount'] = ceil($rowCount / $perPageCount);
    $resultSet['lowerLimit'] = ($pageNumber - 1) * $perPageCount;
    $resultSet['rowCount'] = $rowCount;
    return $resultSet;
}