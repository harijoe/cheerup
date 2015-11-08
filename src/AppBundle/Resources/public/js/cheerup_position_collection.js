$(document).ready(function () {

    var $collectionContainer = $('.collection_container');
    $collectionContainer.manageCollection();
    $collectionContainer.on('after-add', function(event) {
        toDatepicker(event.addedItem.find('.cheerup-position-datepicker'));
    }.bind(this));

    toDatepicker($('.cheerup-position-datepicker'));

    function toDatepicker ($el) {
        $el.datepicker({
            inputs: $el.find('.range_input'),
            format: 'MM yyyy',
            viewMode: 'years',
            minViewMode: 'months',
            language: 'fr'
        });
    }
});
