function setOptions (url, placeholder, data, processResults) {
    return {
        ajax: {
            url: url,
            method: 'POST',
            dataType: 'json',
            delay: 250,
            data: data,
            processResults: processResults
        },   
        // minimumInputLength: 2,     
        width: '100%',
        placeholder: placeholder,
    }
}

// Filter data method
function filterData (search, term) {

    // Check if term is ""
    (term == "" || term == null) ? term = "all" : term = term;

    var results = {};
    if ($.isEmptyObject(filters)) {

        // Check search term is array or string
        if(!$.isArray(search)){

            return {
                [search]: term
            }
        }

        search.forEach(function(item) {
            results[item] = term
        });

        // console.log('result-search');
        console.log(results);

        return results;
    }

    for (var filter in filters) {
        results[filter] = filters[filter];        
    }

    // Check search term is array or string
    if(!$.isArray(search)){
        results[search] = term
    }else{
        search.forEach(function(item) {
            results[item] = term
        });
    }

    // console.log('results');
    console.log(results);

    return results;
}