@extends('layouts.dashbord')

@section('content')
    <main role="main" class="col-md-10 ml-sm-auto col-lg-10 pt-3 px-4">
        <h2>近期数据统计：</h2>
        <div class="wrapper wrapper-content mt-5 mb-4">
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>今日订单</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $dataToday['count'] }}
                                </span>
                                <small>笔</small>
                            </h1>
                            <small>
                                成交金额：{{ $dataToday['total'] }}&yen;
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>昨日订单</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $dataYesterday['count'] }}
                                </span>
                                <small>笔</small>
                            </h1>
                            <small>
                                成交金额：{{ $dataYesterday['total'] }}&yen;
                            </small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>本月订单</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $dataCurMonth['count'] }}
                                </span>
                                <small>笔</small>
                            </h1>
                            <small>成交金额：{{ $dataCurMonth['total'] }} &yen;</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>今年订单</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $dataCurYear['count'] }}
                                </span>
                                <small>笔</small>
                            </h1>
                            <small>成交金额：{{ $dataCurYear['total'] }} &yen;</small>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>新增用户</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $data10DaysSubUser }}
                                </span>
                                <small>人</small></h1>
                            <small>采集最近10天数据</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-danger">
                        <div class="ibox-title">
                            <h5>取消关注</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $data10DaysUnSubUser }}
                                </span>
                                <small>人</small>
                            </h1>
                            <small>采集最近10天数据</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-success">
                        <div class="ibox-title">
                            <h5>净增用户数量</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $data10DaysSubUser - $data10DaysUnSubUser }}
                                </span>
                                <small>人</small>
                            </h1>
                            <small>新增用户 - 取消关注</small>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-1 col-lg-3">
                    <div class="alert alert-primary">
                        <div class="ibox-title">
                            <h5>总用户量</h5>
                        </div>
                        <div class="ibox-content">
                            <h1 class="no-margins">
                                <span class="text-danger">
                                    {{ $dataAllUserNum }}
                                </span>
                                <small>人</small>
                            </h1>
                            <small>所有关注公众号用户</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <h2>意见建议</h2>
        <div class="wrapper wrapper-content mt-5 mb-4">
            <div class="row m-b-sm m-t-sm">
                <div class="col-md-1">
                    <button type="button" id="loading-example-btn" class="btn btn-white btn-sm"><i class="fa fa-refresh"></i> Refresh</button>
                </div>
                <div class="col-md-11">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text">
                                <i class="fa fa-fw fa-search"></i>
                            </span>
                        </div>
                        <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                        <div class="input-group-append">
                            <span class="input-group-text">Go</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="project-list table-responsive">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <td>
                                <span class="label label-primary">2018-1-03 10:23:03</span>
                            </td>
                            <td class="project-title">
                                <p>微信支付还未支持</p>
                            </td>
                            <td class="project-people">
                                <a href="#">
                                    <img
                                        width="40px"
                                        height="40px"
                                        alt="image" 
                                        class="rounded-circle"
                                        src="images/icon/error.png">
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </main>
@endsection