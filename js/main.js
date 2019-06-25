$(document).ready(() => {
    $('#course').change(() => {
        $('#yearLevel').find('option').remove();
        let courseId = $.trim($('#course').val());
        let params = {courseId: courseId};
        $.ajax({
            url: '/app/course_yearlevel.php',
            type: 'get',
            data: params,
            success: (response) => {
                if (!$.isEmptyObject(response)) {
                    let data = JSON.parse(response);
                    let yearLevelSelect = $('#myForm').find('#yearLevel');
                    data.forEach((yearLevel) => {
                        yearLevelSelect.append($('<option></option>').val(yearLevel.yearlevel_id).html(yearLevel.yearlevel_name));
                    });
                } 
            },
            error: (jqXHR, textStatus, errorThrown) => {
                alert("error");
            }
    });
    });
});