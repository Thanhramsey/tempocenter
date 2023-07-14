<?php echo form_open_multipart('admin/cahoc/insert'); ?>
<?php
 
$listHocVien = $this->Mhocvien->hocvien_list();
?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/cahoc/insert.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-cd"></i> Thêm ca học mới</h1>
            <div class="breadcrumb">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                    Lưu[Thêm]
                </button>
                <a class="btn btn-primary btn-sm" href="admin/cahoc" role="button">
                    <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
                </a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
		<div class="box" id="view">
                        <div class="box-body">
            <div class="row">
                <div class="col-md-6">
                
                            <div class="form-group">
                                <label>Thứ <span class="maudo">(*)</span></label>
                                <select name="thu" class="form-control" ">
                                    <option value="">[--Chọn thứ--]</option>
                                    <option value="Thứ 2">Thứ 2</option>
                                    <option value="Thứ 3">Thứ 3</option>
                                    <option value="Thứ 4">Thứ 4</option>
                                    <option value="Thứ 5">Thứ 5</option>
                                    <option value="Thứ 6">Thứ 6</option>
                                    <option value="Thứ 7">Thứ 7</option>
                                    <option value="Chủ Nhật">Chủ Nhật</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Thời gian bắt đầu<span class="maudo">(*)</span></label>
                                <input type="text" id="startTime" class="form-control" name="startTime"
                                    " placeholder="Thời gian" value="17:00">
                                <div class="error" id="password_error"><?php echo form_error('thoigian') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Thời gian kết thúc</label>
                                <input type="text" id="endTime" class="form-control" name="endTime" "
                                    placeholder="Thời gian" value="18:30">
                                <div class="error" id="password_error"><?php echo form_error('thoigian') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Tên ca học <span class="maudo">(Nếu để trống hệ thống tự tạo tên)</span></label>
                                <input type="text" class="form-control" name="name" "
                                    placeholder="Tên ca học">
                                <div class="error" id="password_error"><?php echo form_error('name') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Môn học</label>
                                <select name="monId" class="form-control" ">
                                    <option value="">[--Chọn môn học--]</option>
                                    <?php
									$list = $this->Mmonhoc->monhoc_list();
									$option_parentid = "";
									foreach ($list as $r) {
										if($r['id'] == 1){
											$option_parentid .= "<option selected value='" . $r['id'] . "'>" . $r['name'] . "</option>";
										}
										$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['name'] . "</option>";
									}
									echo $option_parentid;
									?>
                                </select>
                                <div class="error" id="password_error"><?php echo form_error('monId') ?></div>
                            </div>
                            <div class="form-group">
                                <label>Trạng thái</label>
                                <select name="status" class="form-control" ">
                                    <option value="">[--Chọn trạng thái--]</option>
                                    <option value="1" selected>Đang hoạt động</option>
                                    <option value="0">Ngưng hoạt động</option>
                                </select>
                            </div>
                        </div>
                
				<div class="col-md-6">					
                        <div class="form-group">
                            <label>Học viên</label>
                            <select class="select2" multiple name="hocvienId[]" id="hocvienId" class="form-control"
                                style="width:100%">
                                <?php foreach ($listHocVien as $hv): ?>
                                <option value="<?php echo $hv['id']; ?>">
                                    <?php echo $hv['name']; ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                            <div class="error" id="password_error"><?php echo form_error('cahocId') ?></div>
                        </div>
                    </div>
					</div><!-- /.box -->            
                </div>
        </section>
    </form>
    <!-- /.content -->
</div><!-- /.content-wrapper -->

</script>