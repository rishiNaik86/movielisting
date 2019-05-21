$(document).ready(function() 
{
    showRecords(10, 1, 'none', 'none', 'none');
});

function showRecords(perPageCount, pageNumber, sorting, filterLanguage, filterGenre) 
{
    //alert(sorting);
    $.ajax({
        type: "post",
        url: "getResult.php",
        data: { pageNumber: pageNumber, perPageCount: perPageCount, sorting: sorting, filterLanguage: filterLanguage, filterGenre: filterGenre },
        cache: false,
        beforeSend: function() {
            $('#loader').html("<b>Loading response...</b>");		
        },
        success: function(html) 
        {
            $("#results").html(html);
            $('#loader').html('');
        }
    });
}

function sortMovies(sorting)
{
    //alert(sorting.value);
    var filterLanguage = $( "#filter-by-language option:selected" ).val();
    var filterGenre = $( "#filter-by-genre option:selected" ).val();
    showRecords(10, 1, sorting.value, filterLanguage, filterGenre);
}

function filterByLanguage(filterLanguage)
{
    var sorting = $( "#sort-by option:selected" ).val();
    var filterGenre = $( "#filter-by-genre option:selected" ).val();
    showRecords(10, 1, sorting, filterLanguage.value, filterGenre);
}

function filterByGenre(filterGenre)
{
    var sorting = $( "#sort-by option:selected" ).val();
    var filterLanguage = $( "#filter-by-language option:selected" ).val();
    showRecords(10, 1, sorting, filterLanguage, filterGenre.value);
}
            
    
    