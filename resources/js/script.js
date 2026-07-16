$(document).ready(function() {

   
    // 1. ATTENDANCE FORM LOGIC: Fetch Students dynamically by Batch Select
   
    $(document).on('change', '#batch_id', function() {
        const batchId = $(this).val();
        const $tbody = $('#student_sheet_tbody');
        const $sheetContainer = $('#student_sheet_container');
        const $noStudentsAlert = $('#no_students_alert');

        if ($tbody.length > 0) $tbody.empty();
        if ($sheetContainer.length > 0) $sheetContainer.addClass('d-none');
        if ($noStudentsAlert.length > 0) $noStudentsAlert.addClass('d-none');
        
        if (batchId) {
            $.getJSON(`/get-students/${batchId}`, function(students) {
                if (students && students.length > 0) {
                    $.each(students, function(index, student) {
                        const row = `
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">${student.user.name}</td>
                                <td class="text-center">
                                    <div class="btn-group" role="group">
                                        <input type="radio" class="btn-check" name="status[${student.id}]" id="p_${student.id}" value="present" checked autocomplete="off">
                                        <label class="btn btn-outline-success btn-sm px-3" for="p_${student.id}">Present</label>
                                        <input type="radio" class="btn-check" name="status[${student.id}]" id="a_${student.id}" value="absent" autocomplete="off">
                                        <label class="btn btn-outline-danger btn-sm px-3" for="a_${student.id}">Absent</label>
                                    </div>
                                </td>
                            </tr>
                        `;
                        $tbody.append(row);
                    });
                    $sheetContainer.removeClass('d-none');
                } else {
                    $noStudentsAlert.removeClass('d-none');
                }
            });
        }
    });

  
    // 2. MARKS MODULE: Dynamic Student Marks & Subject Dropdown Ingest Engine
   
    $(document).on('change', '#marks_batch_id', function() {
        const batchId = $(this).val();
        const $tbody = $('#marks_sheet_tbody');
        const $sheetContainer = $('#marks_sheet_container');
        const $subjectDropdown = $('#marks_subject_id'); 
        
        if ($tbody.length > 0) $tbody.empty();
        if ($sheetContainer.length > 0) $sheetContainer.addClass('d-none');
        
        if (batchId) {
         
            $.getJSON(`/get-students/${batchId}`, function(students) {
                if (students && students.length > 0) {
                    $.each(students, function(index, student) {
                        const row = `
                            <tr>
                                <td class="ps-4 fw-semibold text-dark">${student.user.name}</td>
                                <td class="text-center">
                                    <input type="number" name="marks[${student.id}]" class="form-control text-center mx-auto marks-input-field" placeholder="0" min="0" max="100" style="width: 120px;" required>
                                </td>
                            </tr>`;
                        $tbody.append(row);
                    });
                    $sheetContainer.removeClass('d-none');
                }
            });

           
            if ($subjectDropdown.length > 0) {
                $subjectDropdown.html('<option value="">Loading subjects...</option>').prop('disabled', true);
                $.getJSON(`/get-subjects/${batchId}`, function(data) {
                    $subjectDropdown.html('<option value="">-- Choose Subject --</option>');
                    $.each(data, function(key, value) {
                        var id = value.id ? value.id : key;
                        var name = value.subject_name ? value.subject_name : value;
                        $subjectDropdown.append('<option value="' + id + '">' + name + '</option>');
                    });
                    $subjectDropdown.prop('disabled', false);
                }).fail(function() {
                    $subjectDropdown.html('<option value="">Error loading subjects</option>');
                });
            }
        }
    });

   
    // 3. SUBJECT DROPDOWN LOADER (Dependent Drops for Attendance Panel)
  
    $('#batch_id').on('change', function() {
        var batchId = $(this).val();
        var subjectDropdown = $('#subject_id');

        if(batchId) {
            subjectDropdown.html('<option value="">Loading subjects...</option>').prop('disabled', false);
            $.ajax({
                url: '/get-subjects/' + batchId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    subjectDropdown.html('<option value="">-- Choose Subject --</option>');
                    $.each(data, function(key, value) {
                        var id = value.id ? value.id : key;
                        var name = value.subject_name ? value.subject_name : value;
                        subjectDropdown.append('<option value="' + id + '">' + name + '</option>');
                    });
                },
                error: function() {
                    subjectDropdown.html('<option value="">Error loading subjects</option>');
                }
            });
        } else {
            subjectDropdown.html('<option value="">-- First Choose a Batch --</option>').prop('disabled', true);
        }
    });

    // 4. LIVE CHART.JS ATTENDANCE GRAPH INITIALIZATION
  
    const chartCanvas = document.getElementById('dashboardAttendanceChart');
    if (chartCanvas && typeof Chart !== 'undefined') {
        const ctx = chartCanvas.getContext('2d');
        const labels = window.dashboardChartLabels || ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'];
        const dataValues = window.dashboardChartData || [80, 85, 90, 88, 95];

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Attendance Rate (%)',
                    data: dataValues,
                    borderColor: '#0d6efd', 
                    borderWidth: 2,
                    fill: false,          
                    tension: 0.25            
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: { legend: { display: false } }
            }
        });
    }


    // 5. SIDEBAR RESPONSIVE UNIVERSAL ENGINE (Supports All Portal Toggles)

    $(document).on("click", "#sidebarToggle", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".sidebar").addClass("active");
        $("body").addClass("sidebar-open"); // Triggers overlay blur settings
    });

    $(document).on("click", "#sidebarClose", function (e) {
        e.preventDefault();
        e.stopPropagation();
        $(".sidebar").removeClass("active");
        $("body").removeClass("sidebar-open");
    });

    $(document).on("click", function (e) {
        if ($(".sidebar").hasClass("active") && !$(e.target).closest('.sidebar').length) {
            $(".sidebar").removeClass("active");
            $("body").removeClass("sidebar-open");
        }
    });

    // 6. EARLY WARNING SYSTEM NODES
   
    $('#warning_batch_id').on('change', function() {
        const batchId = $(this).val();
        const $studentDropdown = $('#warning_student_dropdown');

        $studentDropdown.empty().append('<option value="" selected disabled>Loading students...</option>').prop('disabled', true);

        if (batchId) {
            $.getJSON(`/get-students/${batchId}`, function(students) {
                $studentDropdown.empty();
                if (students && students.length > 0) {
                    $studentDropdown.append('<option value="" selected disabled>Choose student...</option>');
                    $.each(students, function(index, student) {
                        const name = (student.user && student.user.name) ? student.user.name : 'Unknown Student';
                        $studentDropdown.append(`<option value="${student.id}">${name}</option>`);
                    });
                    $studentDropdown.prop('disabled', false);
                } else {
                    $studentDropdown.append('<option value="" selected disabled>No students found in this batch</option>');
                }
            });
        }
    });
    $(document).on('click', '.alert button, .alert .btn-close, [data-bs-dismiss="alert"]', function(e) {
    e.preventDefault();
    $(this).closest('.alert').fadeOut(300, function() {
        $(this).remove(); 
    });
});
});