<?php echo form_open_multipart('admin/nhanvien/index'); ?>
<?php
$listCa = [
    [
        "id" => 1,
        "name" => "Ca sáng"
    ],
    [
        "id" => 2,
        "name" => "Ca chiều"
    ],
    [
        "id" => 3,
        "name" => "Ca tối"
    ],
];
?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/nhanvien/index.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Danh mục nhân viên</h1>
            <div class="breadcrumb">
                <a class="btn btn-primary btn-sm" href="admin/nhanvien/insert" role="button">
                    <span class="glyphicon glyphicon-plus"></span> Thêm mới
                </a>
                <a class="btn btn-primary btn-sm" href="admin/nhanvien/recyclebin" role="button">
                    <span class="glyphicon glyphicon-trash"></span> Thùng rác (<?php $total = $this->Mnhanvien->nhanvien_trash_count();
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
                                                <th class="text-center">ID</th>
                                                <th class="text-center">Tên nhân viên</th>
                                                <th class="text-center">Chấm công</th>
                                                <th class="text-center">Ca làm</th>
                                                <th class="text-center">Năm sinh</th>
                                                <th class="text-center">Địa chỉ</th>
                                                <th class="text-center">SĐT</th>
                                                <th class="text-center">Trạng thái</th>
                                                <th class="text-center">Thao tác</th>
                                                <th class="text-center">Thao tác</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list as $row) : ?>
                                            <tr>
                                                <td class="text-center" data-id=<?php echo $row['id'] ?>>
                                                    <?php echo $row['id'] ?></td>
                                                <td class="text-center" data-name=<?php echo $row['name'] ?>>
                                                    <?php echo $row['name'] ?></td>
                                                <td class="text-center">
                                                    <button type="button" class="btn btn-success btn-xs btn-open-modal"
                                                        data-toggle="modal" data-target="#myModal">
                                                        Chấm công
                                                    </button>
                                                </td>
                                                <td class="text-center">
                                                    <?php
                                                    $cahoc = $row['calamid'];
                                                    $selectedIds = json_decode($cahoc);
                                                    foreach ( $selectedIds as $num){
                                                        if($num==1){
                                                            echo "Ca sáng ";
                                                        }
                                                        if($num==2){
                                                            echo "--Ca chiều--";
                                                        }
                                                        if($num==3){
                                                            echo "--Ca tối--";
                                                        }
                                                    }    
                                                    ?>
                                                </td>
                                                <td class="text-center"><?php echo $row['ngaysinh'] ?></td>
                                                <td class="text-center"><?php echo $row['diachi'] ?></td>
                                                <td class="text-center"><?php echo $row['phone'] ?></td>
                                                <td class="text-center">
                                                    <a
                                                        href="<?php echo base_url() ?>admin/nhanvien/status/<?php echo $row['id'] ?>">
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
                                                        href="<?php echo base_url() ?>admin/nhanvien/update/<?php echo $row['id'] ?>"
                                                        role="button">
                                                        <span class="glyphicon glyphicon-edit"></span>Sửa
                                                    </a>
                                                    <?php else : ?>
                                                    <span class="glyphicon glyphicon-remove-circle maudo"></span>
                                                    <?php endif; ?>
                                                </td>
                                                <td class="text-center">
                                                    <a class="btn btn-danger btn-xs"
                                                        href="<?php echo base_url() ?>admin/nhanvien/trash/<?php echo $row['id'] ?>"
                                                        onclick="return confirm('Xác nhận xóa nhân viênnày ?')"
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

            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <h4 class="modal-title" id="myModalLabel">Chấm công nhân viên</h4>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <h5 id="alert" hidden style="color:red ; padding-left:15px">Còn nhập thiếu thông tin
                                </h5>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tên nhân viên</label>
                                        <input type="text" id="tenNhanVien" name="tenNhanVien"
                                            style="display:block;height:35px;width:250px" disabled>
                                    </div>
                                    <div class="form-group">
                                        <label>Chọn ca<span class="maudo">(*)</span></label>
                                        <select class="select2" multiple name="calamid[]" id="calamid"
                                            class="form-control" style="width:250px">
                                            <option value="">Chọn ca</option>
                                            <option value="1">Sáng</option>
                                            <option value="2">Chiều</option>
                                            <option value="3">Tối</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Chọn Ngày <span class="maudo">(*)</span></label>
                                        <input type="text" id="datepicker" name="datepicker"
                                            style="display:block;height:35px;width:250px">
                                    </div>
                                    <div class="form-group">
                                        <label>Số giờ làm <span class="maudo">(*)</span></label>
                                        <input type="number" id="hour" name="hour" max="24"
                                            style="display:block;height:35px;width:250px" value="0">
                                        <input hidden type="text" id="nhanvienid" name="nhanvienid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" onclick="chamcong()">Lưu Chấm Công</button>
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
$(document).ready(function() {
    // Lắng nghe sự kiện click của nút mở modal
    var today = new Date();
    var formattedDate = validDay(today);

    $('.btn-open-modal').on('click', function() {
        var nhanvienid = $(this).closest('tr').find('td[data-id]').data('id');
        var tenNhanVien = $(this).closest('tr').find('td[data-name]').data('name');
        $('#nhanvienid').val(nhanvienid);
        $('#tenNhanVien').val(tenNhanVien);
        $("#alert").hide();
        getdulieuchamcong(nhanvienid, formattedDate);
    });
    $("#datepicker").val(formattedDate);
    $("#datepicker").datepicker({
        dateFormat: "yy-mm-dd", // Định dạng ngày tháng
        changeMonth: true, // Cho phép thay đổi tháng
        changeYear: true, // Cho phép thay đổi năm
        yearRange: "2020:2030", // Phạm vi năm cho phép
        maxDate: 0,
        onSelect: function(dateText, inst) {
            var selectDate = validDay(dateText);
            getdulieuchamcong($('#nhanvienid').val(), selectDate);
        },
    });
});

function chamcong() {
    var validDate = validDay($("#datepicker").val());
    var checkForm = true;
    if (validDate == "" || $("#hour").val() == "0" || $("#calamid").val() === null) {
        checkForm = false;
        $("#alert").show();
    }

    var isInsert = true;


    if (checkForm) {
        var strurl = "<?php echo base_url();?>" + '/admin/nhanvien/getdulieuchamcong';
        jQuery.ajax({
            url: strurl,
            type: "POST",
            data: {
                "nhanvienid": $('#nhanvienid').val(),
                "ngaychamcong": validDate
            },
            dataType: "json",
            success: function(data) {
                if (data.message.length > 0) {
                    var strurlupdate = "<?php echo base_url();?>" + '/admin/nhanvien/chamcongupdate';
                    jQuery.ajax({
                        url: strurlupdate,
                        type: "POST",
                        dataType: "json",
                        data: {
                            "nhanvien_id": $('#nhanvienid').val(),
                            "ngaydiemdanh": validDate,
                            "giolam": $("#hour").val(),
                            "calamid": $("#calamid").val(),
                        },
                        success: function(data) {
                            $("#alert").hide();
                            $('#myModal').modal('hide');
                        },
                    });
                } else {
                    var strurlInsert = "<?php echo base_url();?>" + '/admin/nhanvien/chamconginsert';
                    jQuery.ajax({
                        url: strurlInsert,
                        type: "POST",
                        dataType: "json",
                        data: {
                            "nhanvien_id": $('#nhanvienid').val(),
                            "ngaydiemdanh": validDate,
                            "giolam": $("#hour").val(),
                            "calamid": $("#calamid").val(),
                        },
                        success: function(data) {
                            $("#alert").hide();
                            $('#myModal').modal('hide');
                        },
                    });
                }
            },
        });

    }

}

function getdulieuchamcong(nhanvienid, ngaychamcong) {
    var strurl = "<?php echo base_url();?>" + '/admin/nhanvien/getdulieuchamcong';
    jQuery.ajax({
        url: strurl,
        type: "POST",
        data: {
            "nhanvienid": nhanvienid,
            "ngaychamcong": ngaychamcong
        },
        dataType: "json",
        success: function(data) {
            if (data.message.length > 0) {
                $("#hour").val(data.message[0].giolam);
                var selectedIds = JSON.parse(data.message[0].calamid);
                $('#calamid').val(selectedIds).trigger('change');
            } else {
                $("#calamid").val([]).trigger('change');
                $("#hour").val(0);
            }
        },
    });
}
</script>