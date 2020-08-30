@extends('layouts.adminsidebarlayout')
@section('content')
<div class="col-md-12">
    <!-- BEGIN CONTENT BODY -->
    <div class="page-content">
        <!-- BEGIN PAGE TITLE-->
        <h3 class="page-title"> Create Course </h3>
        <!-- END PAGE TITLE-->
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line boxless tabbable-reversed">
                    
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab_0">
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-gift"></i>Create Course </div>
                                    <div class="tools">
                                        <a href="javascript:;" class="collapse"> </a>
                                        <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                                        <a href="javascript:;" class="reload"> </a>
                                        <a href="javascript:;" class="remove"> </a>
                                    </div>
                                </div>
                                <div class="portlet-body form">
                                                            <!-- BEGIN FORM-->
                                    <form action="#" class="form-horizontal" method="post" enctype="multipart/form-data">
                                        <div class="form-body">
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Course Name</label>
                                                <div class="col-md-4">
                                                    <input type="text" class="form-control input-circle" placeholder="Enter text">       
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Select Category</label>
                                                <div class="col-md-4">
                                                    <select class="form-control input-circle">
                                                        <option>Please select</option>
                                                        <option>Business</option>
                                                        <option>Lifestyle</option>
                                                        <option>Personal development</option>
                                                        <option>Academics</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="col-md-3 control-label">Course Descrption</label>
                                                <div class="col-md-4">
                                                    <textarea class="form-control input-circle" rows="3"></textarea>
                                                </div>
                                            </div>
                                                        
                                            <div class="form-group">
                                                    <label class="col-md-3 control-label">Course Price</label>
                                                    <div class="col-md-4">
                                                        <input type="text" class="form-control input-circle" placeholder="Enter Price">
                                                    </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-3">Upload Video </label>
                                                <div class="col-md-9">
                                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                                        <span class="btn green btn-file">
                                                            <span class="fileinput-new"> Add Course </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="hidden" value="" name="..."><input type="file" name=""> </span>
                                                        <span class="fileinput-filename"></span> &nbsp;
                                                        <a href="javascript:;" class="close fileinput-exists" data-dismiss="fileinput"> </a>
                                                    </div>
                                                </div>
                                            </div>   
                                        </div>
                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-3 col-md-9">
                                                    <button type="submit" class="btn btn-circle green">Submit</button>
                                                    <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- END FORM-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>                <!-- END CONTENT BODY -->
</div>                      
@stop