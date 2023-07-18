<?php echo form_open_multipart('admin/diemdanh/index'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/diemdanh/index.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Danh mục điểm danh</h1>
            <div class="breadcrumb">
                <?php
			if ($user['role'] == 1) {
				echo '<a class="btn btn-primary btn-sm" href="' . base_url() . 'admin/cahoc/insert" role="button">
				<span class="glyphicon glyphicon-plus"></span> Thêm mới
				</a>';
			}
			?>
                <a class="btn btn-primary btn-sm" href="admin/cahoc/recyclebin" role="button">
                    <span class="glyphicon glyphicon-trash"></span> Thùng rác (<?php $total = $this->Mcahoc->cahoc_trash_count();
																			echo $total; ?>)
                </a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Chọn Ngày <span class="maudo">(*)</span></label>
                            <input type="text" id="datepicker" name="datepicker"
                                style="display:block;height:35px;width:250px" value="<?php echo $ngaydiemdanh?>">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label>Ca</label>
                            <select name="caId" id="caId" class="form-control" style="width:250px">
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label></label>
                            <button type="submit" class="btn btn-primary btn-sm" style="margin-top:25px">
                                <span class="glyphicon glyphicon-search"></span>
                                Tìm kiếm
                            </button>
                            <button type="button" id="diemdanh_btn" class="btn btn-primary btn-sm"
                                style="margin-top:25px ; display:none" onclick="diemdanh()">
                                <span class="glyphicon glyphicon-search"></span>
                                Điểm Danh
                            </button>
                        </div>
                    </div>


                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="box" id="view">
                        <!-- /.box-header -->
                        <div class="box-body">
                            <?php if ($this->session->flashdata('success')) : ?>
                            <div class="row">
                                <div class="alert alert-success">
                                    <?php echo $this->session->flashdata('success'); ?>
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php if ($this->session->flashdata('error')) : ?>
                            <div class="row">
                                <div class="alert alert-error">
                                    <?php echo $this->session->flashdata('error'); ?>
                                    <button type="button" class="close" data-dismiss="alert"
                                        aria-hidden="true">×</button>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="row" style='padding:0px; margin:0px;'>
                                <!--ND-->
                                <div class="table-responsive">
                                    <table id="diemdanhTable" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><input onchange="checkallchange()"
                                                        type="checkbox" id="check-all" class="check-all"></th>
                                                <th class="text-center">Tên ca học</th>
                                                <th class="text-center">Tên học viên</th>
                                                <th class="text-center">ID</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $row) : ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" class="check-row"></td>
                                                <td class="text-center"> <?php echo $row['cahoc_name'] ?></td>
                                                <td class="text-center"><?php echo $row['hocvien_name'] ?></td>
                                                <td class="text-center"><?php echo $row['hocvien_id'] ?></td>
                                            </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <ul class="pagination">
                                            <?php echo $strphantrang ?>
                                        </ul>
                                    </div>
                                </div>
                                <!-- /.ND -->
                            </div>
                        </div><!-- ./box-body -->
                    </div><!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </form>
</div><!-- /.content-wrapper -->

<script src="public/js/module/diemdanh.js"></script>

<script>
var arrData = [];
$(document).ready(function() {
    var days = [
        "Chủ nhật",
        "Thứ 2",
        "Thứ 3",
        "Thứ 4",
        "Thứ 5",
        "Thứ 6",
        "Thứ 7",
    ];
    var today = new Date();
    var dayOfWeek = today.getDay();
    var todayName = days[dayOfWeek];


    var strurl = "<?php echo base_url();?>" + '/admin/cahoc/listCaHocTheoThu';
    jQuery.ajax({
        url: strurl,
        type: "POST",
        dataType: "json",
        data: {
            thu: todayName,
        },
        success: function(data) {
            if (data) {
                $("#caId").html(data.message);
                $('#caId').val(<?php echo $cahoc ?>);
            } else {
                $("#caId").html("");
            }
        },
    });

    $("#datepicker").datepicker({
        dateFormat: "dd-mm-yy", // Định dạng ngày tháng
        changeMonth: true, // Cho phép thay đổi tháng
        changeYear: true, // Cho phép thay đổi năm
        yearRange: "2020:2030", // Phạm vi năm cho phép
        onSelect: function(dateText, inst) {
            // Gọi hàm lấy thứ khi người dùng chọn một ngày
            var selectedDate = new Date(
                inst.selectedYear,
                inst.selectedMonth,
                inst.selectedDay
            );
            var dayOfWeek = selectedDate.getDay(); // Lấy thứ (0: Chủ nhật, 1: Thứ 2, ..., 6: Thứ 7)
            console.log(days[dayOfWeek]);
            var strurl = "<?php echo base_url();?>" + '/admin/cahoc/listCaHocTheoThu';
            jQuery.ajax({
                url: strurl,
                type: "POST",
                dataType: "json",
                data: {
                    thu: days[dayOfWeek],
                },
                success: function(data) {
                    if (data) {
                        $("#caId").html(data.message);
                    } else {
                        $("#caId").html("");
                    }
                },
            });
        },
    });


    var table = $('#diemdanhTable').DataTable({
        columnDefs: [{
            targets: 0,
            orderable: false // Vô hiệu hóa sắp xếp cho cột này
        }]
    });


    $('#diemdanhTable tbody').on('change', '.check-row', function() {
        var isChecked = $(this).prop('checked');
        console.log($(this), isChecked)
        if (!isChecked) {
            $('#check-all').prop('checked', false);
        } else {
            // Kiểm tra xem tất cả các checkboxes cá nhân đã được chọn hay không
            var allChecked = $('.check-row:checked').length === $('.check-row').length;
            $('#check-all').prop('checked', allChecked);

            var row = $(this).closest('tr');
            var rowData = table.row(row).data();

            var obj = {
                id: rowData[3],
                ca: rowData[1],
                tenhv: rowData[2],
            }
            console.log('Dữ liệu từ hàng đó:', obj, rowData);
            arrData.push(obj);

        }

        if ($('.check-row:checked').length > 0) {
            $('#diemdanh_btn').show();
        } else {
            $('#diemdanh_btn').hide();
        }
    });


});

function checkallchange() {
    if ($('#check-all').is(":checked")) {
        $('.check-row').prop('checked', true);
        $('#diemdanh_btn').show();
        $('.check-row:checked').each(function() {
            var rowData = {
                id: $(this).closest('tr').find('td:nth-child(4)').text(),
                ca: $(this).closest('tr').find('td:nth-child(2)').text(),
                tenhv: $(this).closest('tr').find('td:nth-child(3)').text()
            };
            arrData.push(rowData);
        });
    } else {
        $('.check-row').prop('checked', false);
        $('#diemdanh_btn').hide();
        arrData = [];
    }

}

function diemdanh() {
    console.log(arrData);
}
</script>