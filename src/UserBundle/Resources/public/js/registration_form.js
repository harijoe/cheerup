$( document ).ready(function() {
    const FORMER_MEMBER = 'FORMER_MEMBER';
    var $userTypeSelect = $('#fos_user_registration_form_profileType');
    var $offshootSelect = $('#fos_user_registration_form_offshootOfOrigin')
    var $offshootSelectFormGroup = $offshootSelect.closest('.form-group');

    $userTypeSelect.on('change', function() {
        showOrHideOffshootFormGroup();
    });

    function showOrHideOffshootFormGroup() {
        if ($userTypeSelect.val() === FORMER_MEMBER) {
            $offshootSelectFormGroup.show();
            $offshootSelect.removeAttr('disabled');
        } else {
            $offshootSelectFormGroup.hide();
            $offshootSelect.attr('disabled', 'disabled');
        }
    }

    // Initialization
    showOrHideOffshootFormGroup();
});
