<?php echo form_open_multipart('admin/hocvien/index'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/hocvien/index.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Danh mục học viên</h1>
            <div class="breadcrumb">
                <?php
			if ($user['role'] == 1) {
				echo '<a class="btn btn-primary btn-sm" href="' . base_url() . 'admin/hocvien/insert" role="button">
				<span class="glyphicon glyphicon-plus"></span> Thêm mới
				</a>';
			}
			?>
                <a class="btn btn-primary btn-sm" href="admin/hocvien/recyclebin" role="button">
                    <span class="glyphicon glyphicon-trash"></span> Thùng rác (<?php $total = $this->Mhocvien->hocvien_trash_count();
																			echo $total; ?>)
                </a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
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
                                    <table id="myTable" class="table table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="text-center"><input onchange="checkallchange()"
                                                        type="checkbox" id="check-all" class="check-all"></th>
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Tên học viên</th>
                                                <th class="text-center">Ca học</th>
                                                <th class="text-center">Lịch sử</th>
                                                <th class="text-center">Năm sinh</th>
                                                <th class="text-center">giới tính</th>
                                                <th class="text-center">SĐT</th>
                                                <th class="text-center">Môn học</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th class="text-center">Thao tác</th>
                                                <th class="text-center">Thao tác</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $row) : ?>
                                            <tr>
                                                <td class="text-center"><input type="checkbox" class="check-row"></td>
                                                <td class="text-center" data-id=<?php echo $row['id'] ?>>
                                                    <?php echo $row['id'] ?></td>
                                                <td class="text-center"><?php echo $row['name'] ?></td>
                                                <td class="text-center"><?php echo $row['ca_hoc'] ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-xs btn-ls-diemdanh"
                                                        data-toggle="modal" data-target="#lsDiemDanh">
                                                        Tra cứu
                                                    </button>
                                                </td>
                                                <td class="text-center"><?php echo $row['ngaysinh'] ?></td>
                                                <td class="text-center"><?php echo $row['gioitinh'] ?></td>
                                                <td class="text-center"><?php echo $row['phone'] ?></td>
                                                <td class="text-center"><?php
													$monhoc = $this->Mmonhoc->monhoc_detail($row['monId']);
													echo $monhoc['name'];
												?></td>
                                                <td class="text-center">
                                                    <a
                                                        href="<?php echo base_url() ?>admin/hocvien/status/<?php echo $row['id'] ?>">
                                                        <?php if ($row['status'] == 1) : ?>
                                                        <span class="glyphicon glyphicon-ok-circle mauxanh18"></span>
                                                        <?php else : ?>
                                                        <span class="glyphicon glyphicon-remove-circle maudo"></span>
                                                        <?php endif; ?>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    <?php if ($user['role'] == 1) : ?>
                                                    <a class="btn btn-success btn-xs"
                                                        href="<?php echo base_url() ?>admin/hocvien/update/<?php echo $row['id'] ?>"
                                                        role="button">
                                                        <span class="glyphicon glyphicon-edit"></span>Sửa
                                                    </a>
                                                    <?php else : ?>
                                                    <span class="glyphicon glyphicon-remove-circle maudo"></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-xs"
                                                        href="<?php echo base_url() ?>admin/hocvien/trash/<?php echo $row['id'] ?>"
                                                        onclick="return confirm('Xác nhận xóa học viên này ?')"
                                                        role="button">
                                                        <span class="glyphicon glyphicon-trash"></span>Xóa
                                                    </a>
                                                </td>
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
            <!-- Lịch sử Chấm công modal -->
            <div class="modal fade" id="lsDiemDanh" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Lịch sử Điểm Danh học viên</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h5 id="alert" hidden style="color:red ; padding-left:15px">Còn nhập thiếu thông tin
                                </h5>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chọn Từ Ngày <span class="maudo">(*)</span></label>
                                        <input type="text" id="tuNgay" name="tuNgay"
                                            style="display:block;height:35px;width:250px">
                                        <input type="text" id="lsdiemdanhid" hidden>
                                    </div>

                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chọn Đến Ngày <span class="maudo">(*)</span></label>
                                        <input type="text" id="denNgay" name="denNgay"
                                            style="display:block;height:35px;width:250px">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <table id="lsTable" class="table table-hover table-bordered no-footer">
                                        <thead>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="col-md-12">
                                    <h4 id="tongtien" style="color:red;font-weight:bold"></h4>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Đóng</button>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </form>
</div><!-- /.content-wrapper -->

<script type="text/javascript">
function validDay(day) {
    const datePattern = /^\d{4}-\d{2}-\d{2}$/;
    var validDateString = "";
    if (datePattern.test(day)) {
        validDateString = day;
    } else {
        validDateString = moment(day, 'DD-MM-YYYY').format('YYYY-MM-DD');
    }
    return validDateString;
}
var dataTable;
$(document).ready(function() {
    var today = new Date();
    var firstDateOfMonth = new Date(today.getFullYear(), today.getMonth(), 1);
    var formattedDate = validDay(today);
    var validFirstDate = validDay(firstDateOfMonth);

    $('.btn-ls-diemdanh').on('click', function() {
        var hocvienid = $(this).closest('tr').find('td[data-id]').data('id');
        $("#lsdiemdanhid").val(hocvienid);
        var strurl = "<?php echo base_url();?>" + '/admin/hocvien/lsDiemDanhHocVien';
        jQuery.ajax({
            url: strurl,
            type: "POST",
            dataType: "json",
            data: {
                "hocvienid": hocvienid,
                "tuNgay": validFirstDate,
                "denNgay": formattedDate
            },
            success: function(data) {
                console.log("data", data);
                if (data.message.length > 0) {
                    if (dataTable) {
                        dataTable.destroy();
                    }
                    dataTable = $("#lsTable").DataTable({
                        data: data.message, // Pass the data array to the DataTable
                        columns: [{
                                data: "ten_hocvien",
                                title: "Tên Học viên"
                            },
                            {
                                data: "ngaydiemdanh",
                                title: "Ngày điểm danh"
                            },
                            {
                                data: "ten_cahoc",
                                title: "Ca học"
                            },
                        ],
                    });
                    $("#tongtien").html("Tổng số buổi học là: " + data.message.length);
                } else {
                    if (dataTable) {
                        dataTable.destroy();
                    }
                    dataTable = $("#lsTable").DataTable({
                        data: data.message, // Pass the data array to the DataTable
                        columns: [{
                                data: "ten_hocvien",
                                title: "Tên Học viên"
                            },
                            {
                                data: "ngaydiemdanh",
                                title: "Ngày điểm danh"
                            },
                            {
                                data: "ten_cahoc",
                                title: "Ca học"
                            },
                        ],
                    });
                    $("#tongtien").html(
                        "Học viên chưa được ghi nhận giờ học nào trong khoảng thời gian!"
                    );
                }
            },
        });
    });
    $("#tuNgay").val(validFirstDate);
    $("#denNgay").val(formattedDate);
    $("#tuNgay").datepicker({
        dateFormat: "yy-mm-dd", // Định dạng ngày tháng
        changeMonth: true, // Cho phép thay đổi tháng
        changeYear: true, // Cho phép thay đổi năm
        yearRange: "2020:2030", // Phạm vi năm cho phép
        maxDate: 0,
        onSelect: function(dateText, inst) {
            updateTable($("#lsdiemdanhid").val(), validDay($("#tuNgay").val()), validDay($(
                "#denNgay").val()));
        },
    });
    $("#denNgay").datepicker({
        dateFormat: "yy-mm-dd", // Định dạng ngày tháng
        changeMonth: true, // Cho phép thay đổi tháng
        changeYear: true, // Cho phép thay đổi năm
        yearRange: "2020:2030", // Phạm vi năm cho phép
        maxDate: 0,
        onSelect: function(dateText, inst) {
            updateTable($("#lsdiemdanhid").val(), validDay($("#tuNgay").val()), validDay($(
                "#denNgay").val()));
        },
    });
});

function updateTable(lsdiemdanhid, tuNgay, denNgay) {
    var strurl = "<?php echo base_url();?>" + '/admin/hocvien/lsDiemDanhHocVien';
    jQuery.ajax({
        url: strurl,
        type: "POST",
        dataType: "json",
        data: {
            "hocvienid": lsdiemdanhid,
            "tuNgay": tuNgay,
            "denNgay": denNgay
        },
        success: function(data) {
            if (data.message.length > 0) {
                if (dataTable) {
                    dataTable.destroy();
                }
                dataTable = $("#lsTable").DataTable({
                    data: data.message, // Pass the data array to the DataTable
                    columns: [{
                            data: "ten_hocvien",
                            title: "Tên Học viên"
                        },
                        {
                            data: "ngaydiemdanh",
                            title: "Ngày điểm danh"
                        },
                        {
                            data: "ten_cahoc",
                            title: "Ca học"
                        },
                    ],
                });
                var sum = 0;
                data.message.forEach((record) => {
                    sum = sum + parseFloat(record.sotien);
                });
                $("#tongtien").html("Tổng số buổi học là: " + data.message.length);
            } else {
                if (dataTable) {
                    dataTable.destroy();
                }
                dataTable = $("#lsTable").DataTable({
                    data: data.message, // Pass the data array to the DataTable
                    columns: [{
                            data: "ten_hocvien",
                            title: "Tên Học viên"
                        },
                        {
                            data: "ngaydiemdanh",
                            title: "Ngày điểm danh"
                        },
                        {
                            data: "ten_cahoc",
                            title: "Ca học"
                        },
                    ],
                });
                $("#tongtien").html(
                    "Học viên chưa được ghi nhận giờ học nào trong khoảng thời gian!"
                );
            }
        },
    });
}
</script>