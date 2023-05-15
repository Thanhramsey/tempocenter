<?php echo form_open_multipart('admin/chinhsach/insert'); ?>
<div class="content-wrapper">
    <form action="<?php echo base_url() ?>admin/chinhsach/insert.html" enctype="multipart/form-data" method="POST"
        accept-charset="utf-8">
        <section class="content-header">
            <h1><i class="glyphicon glyphicon-text-background"></i> Thêm mới văn bản</h1>
            <div class="breadcrumb">
                <button type="submit" class="btn btn-primary btn-sm">
                    <span class="glyphicon glyphicon-floppy-save"></span>
                    Lưu[Thêm]
                </button>
                <a class="btn btn-primary btn-sm" href="admin/chinhsach" role="button">
                    <span class="glyphicon glyphicon-remove do_nos"></span> Thoát
                </a>
            </div>
        </section>
        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="box" id="view">
                        <div class="box-body">
                            <div class="col-md-8">
                                <div class="form-group">
                                    <label>Tên hóa đơn<span class="maudo">(*)</span></label>
                                    <input type="text" class="form-control" name="name" style="width:100%"
                                        placeholder="Tên hóa đơn">
                                    <div class="error" id="password_error"><?php echo form_error('name') ?></div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-md-4" style="padding-left: 0px;">
                                            <div class="form-group">
                                                <label>Loại hóa đơn<span class="maudo">(*)</span></label>
                                                <select name="typeHd" class="form-control" id="typeHd">
                                                    <option value="">[--Chọn loại hóa đơn--]</option>
                                                    <option value='1'>Học phí</option>
                                                    <option value='2'>Bán nhạc cụ</option>
                                                </select>
                                                <div class="error" id="password_error">
                                                    <?php echo form_error('typeHd') ?></div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" style="padding-right: 0px;">
                                            <div class="form-group">
                                                <label>Số hiệu</label>
                                                <input type="text" class="form-control" name="sohieu" style="width:100%"
                                                    placeholder="Số hiệu">
                                                <div class="error" id="password_error">
                                                    <?php echo form_error('sohieu') ?></div>
                                            </div>
                                        </div>
                                        <div id="customer" class="col-md-4" style="padding-right: 0px;display: none">
                                            <div class="form-group">
                                                <label>Chủ hóa đơn</label>
                                                <select name="customer_id" class="form-control">
                                                    <option value="">[--Chọn tên khách hàng--]</option>
                                                    <?php
													$list = $this->Mcustomer->customer_list();
													$option_parentid = "";
													foreach ($list as $r) {
														$option_parentid .= "<option value='" . $r['id'] . "'>" . $r['fullname'] . "</option>";
													}
													echo $option_parentid;
													?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Ngày<span class="maudo">(*)</span></label>
                                            <select name="ngay" class="form-control" id="ngay">
                                                <option value="">[--Ngày--]</option>
                                                <option value='1'>Ngày 1</option>
                                                <option value='2'>Ngày 2</option>
                                                <option value='3'>Ngày 3</option>
                                                <option value='4'>Ngày 4</option>
                                                <option value='5'>Ngày 5</option>
                                                <option value='6'>Ngày 6</option>
                                                <option value='7'>Ngày 7</option>
                                                <option value='8'>Ngày 8</option>
                                                <option value='9'>Ngày 9</option>
                                                <option value='10'>Ngày 10</option>
                                                <option value='11'>Ngày 11</option>
                                                <option value='12'>Ngày 12</option>
                                                <option value='13'>Ngày 13</option>
                                                <option value='14'>Ngày 14</option>
                                                <option value='15'>Ngày 15</option>
                                                <option value='16'>Ngày 16</option>
                                                <option value='17'>Ngày 17</option>
                                                <option value='18'>Ngày 18</option>
                                                <option value='19'>Ngày 19</option>
                                                <option value='20'>Ngày 20</option>
                                                <option value='21'>Ngày 21</option>
                                                <option value='22'>Ngày 22</option>
                                                <option value='23'>Ngày 23</option>
                                                <option value='24'>Ngày 24</option>
                                                <option value='25'>Ngày 25</option>
                                                <option value='26'>Ngày 26</option>
                                                <option value='27'>Ngày 27</option>
                                                <option value='28'>Ngày 28</option>
                                                <option value='29'>Ngày 29</option>
                                                <option value='30'>Ngày 30</option>
                                                <option value='31'>Ngày 31</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Tháng<span class="maudo">(*)</span></label>
                                            <select name="thang" class="form-control" id="thang">
                                                <option value="">[--Tháng--]</option>
                                                <option value='1'>Tháng 1</option>
                                                <option value='2'>Tháng 2</option>
                                                <option value='3'>Tháng 3</option>
                                                <option value='4'>Tháng 4</option>
                                                <option value='5'>Tháng 5</option>
                                                <option value='6'>Tháng 6</option>
                                                <option value='7'>Tháng 7</option>
                                                <option value='8'>Tháng 8</option>
                                                <option value='9'>Tháng 9</option>
                                                <option value='10'>Tháng 10</option>
                                                <option value='11'>Tháng 11</option>
                                                <option value='12'>Tháng 12</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Năm<span class="maudo">(*)</span></label>
                                            <select name="nam" class="form-control" id="nam">
                                                <option value="">[--Năm--]</option>
                                                <option value='2023'>Năm 2023</option>
                                                <option value='2024'>Năm 2024</option>
                                                <option value='2025'>Năm 2025</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>File văn bản</label>
                                    <input type="file" id="file_pdf" name="file_pdf">
                                </div>

                            </div>
                        </div>
                    </div><!-- /.box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </form>
    <!-- /.content -->
</div><!-- /.content-wrapper -->