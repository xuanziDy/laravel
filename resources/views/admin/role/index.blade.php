@extends('layouts.admin')
@section('title', '')
@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box box-info" ng-controller="admin-role-indexCtrl"
                 ng-init="data_url='/admin/role/list';delete_url='/admin/role/destroy'">
                <div class="box-header with-border">
                    <h3 class="box-title">角色列表</h3>
                    <div class="box-tools">
                        <div class="input-group">
                            <input type="text"
                                   ng-init="where[0].key='id';where[0].exp='like';where[0].val= where[0].val || '';"
                                   ng-model="where[0].val" placeholder="Search"
                                   class="form-control input-sm pull-right">
                            <div class="input-group-btn">
                                <button ng-init="reset= where[0].val ? 1 : 0" ng-click="getData($this)"
                                        class="btn btn-sm btn-default"><i class="fa fa-search"></i>
                                </button>
                                <button type="button" ng-click="getData($this,{reset:1})"
                                        class="btn btn-sm btn-default"><i class="fa  fa-repeat"></i>
                                </button>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="dataTables_wrapper form-inline dt-bootstrap">
                        <div class="row">
                            <div class="col-sm-6"></div>
                            <div class="col-sm-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable">
                                    <tr role="row">
                                        <th class="sorting" style="width: 30px;">
                                            <input type="checkbox" value="1" name="selectAll"
                                                   ng-click="selectAllId($this,selectAll)"
                                                   ng-model="selectAll">
                                        </th>
                                        <th class="sorting ">角色ID                                                                    <span
                                                    ng-click="getData($this,{'order':'id'})"
                                                    ng-class="{'glyphicon glyphicon-sort-by-attributes-alt':order.id=='desc','glyphicon glyphicon-sort-by-attributes':order.id!='desc'}"></span>
                                        </th>
                                        <th class="sorting ">角色名称                                                                    <span
                                                    ng-click="getData($this,{'order':'name'})"
                                                    ng-class="{'glyphicon glyphicon-sort-by-attributes-alt':order.name=='desc','glyphicon glyphicon-sort-by-attributes':order.name!='desc'}"></span>
                                        </th>
                                        <th class="sorting ">父级ID                                                                    <span
                                                    ng-click="getData($this,{'order':'parent_id'})"
                                                    ng-class="{'glyphicon glyphicon-sort-by-attributes-alt':order.parent_id=='desc','glyphicon glyphicon-sort-by-attributes':order.parent_id!='desc'}"></span>
                                        </th>
                                        <th class="sorting  visible-lg ">创建时间 <i
                                                    class="glyphicon glyphicon-time"></i>                                                                     <span
                                                    ng-click="getData($this,{'order':'created_at'})"
                                                    ng-class="{'glyphicon glyphicon-sort-by-attributes-alt':order.created_at=='desc','glyphicon glyphicon-sort-by-attributes':order.created_at!='desc'}"></span>
                                        </th>
                                        <th class="sorting  visible-lg ">修改时间 <i
                                                    class="glyphicon glyphicon-time"></i>                                                                     <span
                                                    ng-click="getData($this,{'order':'updated_at'})"
                                                    ng-class="{'glyphicon glyphicon-sort-by-attributes-alt':order.updated_at=='desc','glyphicon glyphicon-sort-by-attributes':order.updated_at!='desc'}"></span>
                                        </th>
                                        <th class="sorting">操作</th>
                                    </tr>
                                    <tr ng-repeat="row in data" role="row">
                                        <td>
                                            <input ng-if="row.id != 1 && row.handle" type="checkbox"
                                                   value="@{{row.id}}" name="ids[]"
                                                   ng-model="ids[$index]"
                                                   ng-init="allIds[$index] = row.id"
                                                   ng-true-value="@{{row.id}}" ng-checked="selectAll">
                                        </td>
                                        <td>@{{row.id}}</td>
                                        <td>@{{'deep' | F : row.level}}@{{row.name}}</td>
                                        <td>@{{row.parent_id}}</td>
                                        <td class="visible-lg">@{{ row.created_at}}</td>
                                        <td class="visible-lg">@{{ row.updated_at}}</td>
                                        <td>
                                            <button class="btn btn-xs btn-success" title="成员列表"
                                                    ng-click="userList(row.id)" type="button">
                                                <i class="glyphicon glyphicon-search"></i>
                                            </button>
                                            <a class="btn btn-xs btn-info" title="编辑" role="button"
                                               href="/admin/role/edit/@{{row.id}}">
                                                <i class="glyphicon glyphicon-edit"></i>
                                            </a>
                                            <button ng-if="row.id != 1 && row.handle"
                                                    class="btn btn-xs btn-danger" title="删除"
                                                    ng-click="delete($this,row.id)" type="button">
                                                <i class="glyphicon glyphicon-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-5">
                                <button class="btn btn-default btn-sm" title="删除选中"
                                        ng-click="delete($this)">
                                    <i class="fa fa-trash-o"></i>
                                </button>
                                <button class="btn btn-default btn-sm" title="刷新"
                                        ng-click="getData($this,{refresh:1})">
                                    <i class="fa fa-refresh"></i>
                                </button>
                                <a class="btn btn-default btn-sm" title="添加" href="/admin/role/edit/0">
                                    <i class="fa fa-plus"></i>
                                </a>
                            </div>
                            <div class="col-sm-7 ">
                                <div class="pull-right">
                                    @include('public.page')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box -->
        </div>
        <!-- /.col -->
    </div>
@stop