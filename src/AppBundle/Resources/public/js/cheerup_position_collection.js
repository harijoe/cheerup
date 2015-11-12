$(document).ready(function () {

    var $collectionContainer = $('.collection_container');
    var $collectionHolder= $('.collection_holder');
    var $emptyMessage = $('.cheerup-position-empty-table-message');
    $collectionContainer.manageCollection();
    $collectionContainer.on('after-add', function(event) {
        toDatepicker(event.addedItem.find('.cheerup-position-datepicker'));
        updateEmptyTable();
    }).on('after-delete', function(event) {
        updateEmptyTable();
    }).bind(this);

    toDatepicker($('.cheerup-position-datepicker'));
    updateEmptyTable();

    function toDatepicker ($el) {
        $el.datepicker({
            inputs: $el.find('.range_input'),
            format: 'yyyy-mm-dd',
            //format: {
            //  /*
            //   Say our UI should display a week ahead,
            //   but textbox should store the actual date.
            //   This is useful if we need UI to select local dates,
            //   but store in UTC
            //   */
            //  //toDisplay: function (date, format, language) {
            //  //  var d = new Date(date);
            //  //  return $.datepicker.formatDate('MM yy', d);
            //  //},
            //  toValue: function (date, format, language) {
            //    var d = new Date(date);
            //    return $.datepicker.formatDate('yy-mm-dd', d);
            //  }
            //},
            viewMode: 'years',
            minViewMode: 'months',
            language: 'fr'
        });
    }

    function updateEmptyTable() {
        if (1 === $collectionHolder.children().length) {
            $emptyMessage.show();
        } else {
            $emptyMessage.hide();
        }
    }
});
