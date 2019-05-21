<?php
require_once('../lib/functions.php');

if (!(isset($_POST['pageNumber']))) 
{
    $pageNumber = 1;
} 
else 
{
    $pageNumber = $_POST['pageNumber'];
}

if (!(isset($_POST['perPageCount']))) 
{
    $perPageCount = 10;
} 
else 
{
    $perPageCount = $_POST['perPageCount'];
}

if (!(isset($_POST['sorting']))) 
{
    $sorting = 'none';
} 
else 
{
    $sorting = $_POST['sorting'];
}

if (!(isset($_POST['filterLanguage']))) 
{
    $languageFilter = 'none';
} 
else 
{
    $languageFilter = $_POST['filterLanguage'];
}

if (!(isset($_POST['filterGenre']))) 
{
    $genreFilter = 'none';
} 
else 
{
    $genreFilter = $_POST['filterGenre'];
}

$connection = getDbConnect();

$sqlFilterLanguage = "SELECT * FROM category WHERE type LIKE 'Language'";
$sqlFilterLanguageResult = mysqli_query($connection, $sqlFilterLanguage);

$sqlFilterGenre = "SELECT * FROM category WHERE type LIKE 'Genre'";
$sqlFilterGenreResult = mysqli_query($connection, $sqlFilterGenre);

$selectStatement = "SELECT DISTINCT movie.id as id, movie.title as title, movie.description as description, "
            . "movie.length_in_minutes as length_in_minutes, movie.release_date as release_date FROM movie "
            . "INNER JOIN relationship ON movie.id = relationship.movie_id ";

if (($sorting != 'none') && ($languageFilter != 'none') && ($genreFilter != 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $languageFilter . " OR relationship.category_id = " . $genreFilter . " "
            . "ORDER BY movie." . $sorting . " ASC";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting == 'none') && ($languageFilter != 'none') && ($genreFilter != 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $languageFilter . " OR relationship.category_id = " . $genreFilter . "";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting != 'none') && ($languageFilter == 'none') && ($genreFilter != 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $genreFilter . " "
            . "ORDER BY movie." . $sorting . " ASC";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting != 'none') && ($languageFilter != 'none') && ($genreFilter == 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $languageFilter . " "
            . "ORDER BY movie." . $sorting . " ASC";
    
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting == 'none') && ($languageFilter != 'none') && ($genreFilter == 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $languageFilter . "";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting == 'none') && ($languageFilter == 'none') && ($genreFilter != 'none'))
{
    $sql = $selectStatement . "WHERE relationship.category_id = " . $genreFilter . "";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting == 'none') && ($languageFilter == 'none') && ($genreFilter == 'none'))
{
    $sql = "SELECT DISTINCT * FROM movie WHERE 1";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

if (($sorting != 'none') && ($languageFilter == 'none') && ($genreFilter == 'none'))
{
    $sql = "SELECT DISTINCT * FROM movie WHERE 1 ORDER BY " . $sorting . " ASC";
    $resultSet = getPaginationData($connection, $sql, $perPageCount, $pageNumber);
    $sqlQuery = $sql . " LIMIT " . ($resultSet['lowerLimit']) . " ,  " . ($perPageCount) . " ";
}

$results = mysqli_query($connection, $sqlQuery);       

?>

<div class="form-group col-sm-2">
    <label for="sort-by">Sort By</label>
    <select id="sort-by" onchange="sortMovies(this);" class="form-control">
        <option value="none" <?php if($sorting == 'none'): ?> selected="selected"<?php endif; ?>>None</option>
        <option value="length_in_minutes" <?php if($sorting == 'length_in_minutes'): ?> selected="selected"<?php endif; ?>>Length</option>
        <option value="release_date" <?php if($sorting == 'release_date'): ?> selected="selected"<?php endif; ?>>Release Date</option>            
    </select>
</div>

<div class="form-group col-sm-2">
    <label for="filter-by-language">Filter By Language</label>
    <select id="filter-by-language" onchange="filterByLanguage(this);" class="form-control">
        <option value="none" <?php if($languageFilter == 'none'): ?> selected="selected"<?php endif; ?>>None</option>
        <?php foreach($sqlFilterLanguageResult as $filterLanguage) {?>
        <option value="<?php echo $filterLanguage['id']; ?>" <?php if($languageFilter == $filterLanguage['id']): ?> selected="selected"<?php endif; ?>><?php echo $filterLanguage['value']; ?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group col-sm-2">
    <label for="filter-by-genre">Filter By Genre</label>
    <select id="filter-by-genre" onchange="filterByGenre(this);" class="form-control">
        <option value="none" <?php if($genreFilter == 'none'): ?> selected="selected"<?php endif; ?>>None</option>
        <?php foreach($sqlFilterGenreResult as $filterGenre) {?>
        <option value="<?php echo $filterGenre['id']; ?>" <?php if($genreFilter == $filterGenre['id']): ?> selected="selected"<?php endif; ?>><?php echo $filterGenre['value']; ?></option>
        <?php } ?>           
    </select>
</div>

<?php
if (mysqli_num_rows($results) > 0)
{
?>
<table class="table table-hover table-responsive">
    <tr>
        <th align="center">Record Id</th>
        <th align="center">Title</th>
        <th align="center">Description</th>
        <th align="center">Length<br>(in minutes)</th>
        <th align="center">Release Date</th>
    </tr>
    <?php 
    foreach ($results as $data) 
    { ?>
        <tr>
            <td align="left">
                <?php echo $data['id'] ?>
            </td>
            <td align="left">
                <?php echo $data['title'] ?>
            </td>
            <td align="left">
                <?php echo substr($data['description'], 0, 30) ?>
            </td>
            <td align="left">
                <?php echo $data['length_in_minutes'] ?>
            </td>
            <td align="left">
                <?php echo date("d/m/Y", strtotime($data['release_date']));?>
            </td>
        </tr>
    <?php
    }
    ?>
</table>

<div style="height: 10px;"></div>
<table width="50%" align="center">
    <tr>
        <td valign="top" align="left"><?php echo $resultSet['rowCount'] ?> records found.</td>
        <td valign="top" align="center">
        <?php
            if ($pageNumber != 1)
            {?>
                <a href="javascript:void(0);" class="pages" onclick="showRecords('<?php echo $perPageCount;  ?>', '1', '<?php echo $sorting; ?>', '<?php echo $languageFilter; ?>', '<?php echo $genreFilter; ?>');"><<</a>
                <a href="javascript:void(0);" class="pages" onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo ($pageNumber - 1); ?>', '<?php echo $sorting; ?>', '<?php echo $languageFilter; ?>', '<?php echo $genreFilter; ?>');"><</a>
            <?php
            }
        ?>
        <?php
	    for ($i = 1; $i <= $resultSet['pagesCount']; $i ++) 
            {
                if ($i == $pageNumber) 
                { ?> 
                    <a href="javascript:void(0);" class="current"><?php echo $i ?></a> 
                <?php
                } 
                else 
                { ?>
                    <a href="javascript:void(0);" class="pages" onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $i; ?>', '<?php echo $sorting; ?>', '<?php echo $languageFilter; ?>', '<?php echo $genreFilter; ?>');"><?php echo $i ?></a>
                <?php
                }
            } ?>
        <?php
            if ($pageNumber != $resultSet['pagesCount'])
            {?>
                <a href="javascript:void(0);" class="pages" onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo ($pageNumber + 1); ?>', '<?php echo $sorting; ?>', '<?php echo $languageFilter; ?>', '<?php echo $genreFilter; ?>');">></a>
                <a href="javascript:void(0);" class="pages" onclick="showRecords('<?php echo $perPageCount;  ?>', '<?php echo $resultSet['pagesCount']; ?>', '<?php echo $sorting; ?>', '<?php echo $languageFilter; ?>', '<?php echo $genreFilter; ?>');">>></a>
            <?php
            }
        ?>
        </td>
        <td align="right" valign="top">Page <?php echo $pageNumber; ?> of <?php echo $resultSet['pagesCount']; ?></td>
    </tr>
</table>
<?php
}
else
{
?>
    <div class="col-sm-8">
        <p>No records found.</p>
    </div>
<?php
}
