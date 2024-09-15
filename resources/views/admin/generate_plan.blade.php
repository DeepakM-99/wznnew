@extends('layouts.app')
@section('style')
<!-- Add any custom styles here -->
<style>
    .meal-plan-table {
        width: 100%;
        table-layout: fixed;
    }

    .meal-plan-table th,
    .meal-plan-table td {
        text-align: center;
        vertical-align: middle;
        border: 1px solid #000;
    }

    .meal-plan-table th {
        background-color: #f8f9fa;
    }

    .meal-header {
        background-color: #FFD700; /* Yellow color */
    }

    .meal-header.green {
        background-color: #32CD32; /* Green color */
    }

    .plus-icon {
        cursor: pointer;
        font-size: 24px;
        color: #007bff;
    }

    .plus-icon:hover {
        color: #0056b3;
    }
</style>
@endsection

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Meal-Plan</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Meal-Plan</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Generate Plan</h3>
                    </div>
                    <br>

                    <div class="card-body" style="overflow:scroll;">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th colspan="2" class="meal-header">Week 1</th>
                                    <th colspan="2" class="meal-header green">Week 2</th>
                                </tr>
                            </thead>
                             <tbody>
                                <tr>
                                    <td rowspan="8" style="background-color: #F4A460;">Day1</td>
                                    <td class="meal-header">MEAL 1</td>
                                    <td class="meal-header">SNACK 1</td>
                                    <td class="meal-header green">MEAL 1</td>
                                    <td class="meal-header green">SNACK 1</td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="1" data-meal-type="3">1+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="2" data-meal-type="3">2+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="3" data-meal-type="3">3+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="4" data-meal-type="3">4+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="1" data-meal-type="4">1+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="2" data-meal-type="4">2+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="3" data-meal-type="4">3+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="4" data-meal-type="4">4+</span>
                                        </div>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="5" data-meal-type="3">5+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="6" data-meal-type="3">6+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="7" data-meal-type="3">7+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="8" data-meal-type="3">8+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="5" data-meal-type="4">5+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="6" data-meal-type="4">6+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="7" data-meal-type="4">7+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="8" data-meal-type="4">8+</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 2</td>
                                    <td class="meal-header">SNACK 2</td>
                                    <td class="meal-header green">MEAL 2</td>
                                    <td class="meal-header green">SNACK 2</td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="9" data-meal-type="3">9+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="10" data-meal-type="3">10+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="11" data-meal-type="3">11+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="12" data-meal-type="3">12+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="9" data-meal-type="4">9+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="10" data-meal-type="4">10+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="11" data-meal-type="4">11+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-week="1" data-meal_id="12" data-meal-type="4">12+</span>
                                        </div>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="13" data-meal-type="3">13+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="14" data-meal-type="3">14+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="15" data-meal-type="3">15+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="16" data-meal-type="3">16+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="13" data-meal-type="4">13+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="14" data-meal-type="4">14+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="15" data-meal-type="4">15+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="16" data-meal-type="4">16+</span>
                                        </div>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 3</td>
                                    <td class="meal-header"></td>
                                    <td class="meal-header green">MEAL 3</td>
                                    <td class="meal-header green"></td>
                                </tr>                                
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="17" data-meal-type="3">17+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="18" data-meal-type="3">18+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="19" data-meal-type="3">19+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="20" data-meal-type="3">20+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="21" data-meal-type="3">21+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="22" data-meal-type="3">22+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="23" data-meal-type="3">23+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="24" data-meal-type="3">24+</span>
                                        </div>
                                    </td>

                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 4</td>
                                    <td class="meal-header"></td>
                                    <td class="meal-header green">MEAL 4</td>
                                    <td class="meal-header green"></td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="25" data-meal-type="3">25+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="26" data-meal-type="3">26+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="27" data-meal-type="3">27+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="1" data-meal_id="28" data-meal-type="3">28+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="29" data-meal-type="3">29+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="30" data-meal-type="3">30+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="31" data-meal-type="3">31+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="1" data-week="2" data-meal_id="32" data-meal-type="3">32+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>

                                <!-- Day2 -->
                                <tr>
                                    <td rowspan="8" style="background-color: #F4A460;">Day2</td>
                                    <td class="meal-header">MEAL 1</td>
                                    <td class="meal-header">SNACK 1</td>
                                    <td class="meal-header green">MEAL 1</td>
                                    <td class="meal-header green">SNACK 1</td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="1" data-meal-type="3">1+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="2" data-meal-type="3">2+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="3" data-meal-type="3">3+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="4" data-meal-type="3">4+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="1" data-meal-type="4">1+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="2" data-meal-type="4">2+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="3" data-meal-type="4">3+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="4" data-meal-type="4">4+</span>
                                        </div>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="5" data-meal-type="3">5+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="6" data-meal-type="3">6+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="7" data-meal-type="3">7+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="8" data-meal-type="3">8+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="5" data-meal-type="4">5+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="6" data-meal-type="4">6+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="7" data-meal-type="4">7+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="8" data-meal-type="4">8+</span>
                                        </div>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 2</td>
                                    <td class="meal-header">SNACK 2</td>
                                    <td class="meal-header green">MEAL 2</td>
                                    <td class="meal-header green">SNACK 2</td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="9" data-meal-type="3">9+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="10" data-meal-type="3">10+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="11" data-meal-type="3">11+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="12" data-meal-type="3">12+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="9" data-meal-type="4">9+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="10" data-meal-type="4">10+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="11" data-meal-type="4">11+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="12" data-meal-type="4">12+</span>
                                        </div>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="13" data-meal-type="3">13+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="14" data-meal-type="3">14+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="15" data-meal-type="3">15+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="16" data-meal-type="3">16+</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="13" data-meal-type="4">13+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="14" data-meal-type="4">14+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="15" data-meal-type="4">15+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="16" data-meal-type="4">16+</span>
                                        </div>                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 3</td>
                                    <td class="meal-header"></td>
                                    <td class="meal-header green">MEAL 3</td>
                                    <td class="meal-header green"></td>
                                </tr>                                
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="17" data-meal-type="3">17+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="18" data-meal-type="3">18+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="19" data-meal-type="3">19+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="20" data-meal-type="3">20+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="21" data-meal-type="3">21+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="22" data-meal-type="3">22+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="23" data-meal-type="3">23+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="24" data-meal-type="3">24+</span>
                                        </div>
                                    </td>

                                    <td>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="meal-header">MEAL 4</td>
                                    <td class="meal-header"></td>
                                    <td class="meal-header green">MEAL 4</td>
                                    <td class="meal-header green"></td>
                                </tr>
                                <tr>
                                    <!-- WEEK1 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="25" data-meal-type="3">25+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="26" data-meal-type="3">26+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="27" data-meal-type="3">27+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="1" data-meal_id="28" data-meal-type="3">28+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                    <!-- WEEK2 -->
                                    <td>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="29" data-meal-type="3">29+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="30" data-meal-type="3">30+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="31" data-meal-type="3">31+</span>
                                        </div>
                                        <div>
                                            <span class="plus-icon" data-toggle="modal" data-target="#foodMenuModal" data-day="2" data-week="2" data-meal_id="32" data-meal-type="3">32+</span>
                                        </div>
                                    </td>
                                    <td>
                                    </td>
                                </tr>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Modal for Food Menu -->
<div class="modal fade" id="foodMenuModal" tabindex="-1" role="dialog" aria-labelledby="foodMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="foodMenuModalLabel">Food Menu</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div id="foodMenuContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="saveFoodSelection">Save</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    $(function () {
        $("#example1").DataTable({
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });

        @if (session('message'))
        $(document).Toasts('create', {
            class: 'bg-success',
            title: 'Success',
            body: '{{ session('message') }}'
        });
        @endif

        $('.edit-button').on('click', function () {
            var mealId = $(this).data('meal_id');
            var mealName = $(this).data('meal_name');
            var totalAmount = $(this).data('total_amount');
            var mealCal = $(this).data('meal_calories');

            $('#meal_id').val(mealId);
            $('#meal_name').val(mealName);
            $('#total_amount').val(totalAmount);
            $('#meal_calories').val(mealCal);

            $('#mealForm').attr('action', '{{ route("admin.updatemealplan") }}');
            $('#myModal').modal('show');
        });
    });

    $(document).on('click', '.Confirm', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        console.log("Delete URL:", url);

        Swal.fire({
            title: 'Are you sure?',
            text: "It will permanently delete this meal plan!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                console.log("Confirmed, redirecting to:", url);
                window.location.href = url;
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function () {
        // Calculate the date 2 days after the current date
        var currentDate = new Date();
        currentDate.setDate(currentDate.getDate() + 2);

        // Format the date as yyyy-mm-dd
        var year = currentDate.getFullYear();
        var month = ('0' + (currentDate.getMonth() + 1)).slice(-2);
        var day = ('0' + currentDate.getDate()).slice(-2);

        var minDate = year + '-' + month + '-' + day;

        // Set the min attribute for the from_date input
        document.getElementById('from_date').setAttribute('min', minDate);
    });

$(document).ready(function() {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('#foodMenuModal').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget); // Button that triggered the modal
        var day = button.data('day'); // Extract day from data-* attributes
        var week = button.data('week'); // Extract week from data-* attributes
        var position = button.data('meal_id'); // Get the data-meal_id as position

        console.log('Opening modal for day:', day, 'week:', week); // Debugging log

        $.ajax({
            url: '{{ route("admin.fetch-menu") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                day: day,
                week: week
            },
            success: function(data) {
                if (data.error) {
                    $('#foodMenuContent').html('<p>' + data.error + '</p>');
                } else {
                    console.log('Received menu items:', data.menuItems); // Debugging log

                    var content = '<form id="foodSelectionForm">';
                    content += '<div class="row">'; // Start a new row

                    var half = Math.ceil(data.menuItems.length / 2);
                    var firstHalf = data.menuItems.slice(0, half);
                    var secondHalf = data.menuItems.slice(half);

                    content += '<div class="col-md-6">';
                    firstHalf.forEach(function(item) {
                        if (item.category_id === 3 || item.category_id === 4) {
                            content += '<div>';
                            content += '<input type="radio" name="menu_id" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            content += '<div>Type: ' + item.type + ' $</div>';
                            content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>';
                        }
                    });
                    content += '</div>';

                    content += '<div class="col-md-6">';
                    secondHalf.forEach(function(item) {
                        if (item.category_id === 3 || item.category_id === 4) {
                            content += '<div>';
                            content += '<input type="radio" name="menu_id" value="' + item.menu_id + '"> ';
                            content += '<div>Meal: ' + item.menu + '</div>';
                            content += '<div>Calories: ' + item.calories + '</div>';
                            content += '<div>Type: ' + item.type + ' $</div>';
                            content += '<div><img src="' + item.media_file + '" alt="' + item.menu + '" style="width:100px;height:auto;"/></div>';
                            content += '</div><hr>';
                        }
                    });
                    content += '</div>';

                    content += '</div>';
                    content += '<input type="hidden" name="day" value="' + day + '">';
                    content += '<input type="hidden" name="week" value="' + week + '">';
                    content += '<input type="hidden" name="meal_id" value="1">'; // Set meal_id to 1
                    content += '<input type="hidden" name="position" value="' + position + '">'; // Set the position from data-meal_id
                    content += '</form>';
                    $('#foodMenuContent').html(content);

                    // Set the selected meal_id when a radio button is selected
                    $('input[name="menu_id"]').on('change', function() {
                        $('#selectedMealId').val($(this).val());
                    });
                }
            },
            error: function(xhr) {
                console.error('Error fetching the food menu:', xhr);
                $('#foodMenuContent').html('<p>Error loading food menu.</p>');
            }
        });
    });

    $('#saveFoodSelection').on('click', function() {
        var formData = $('#foodSelectionForm').serialize();
        console.log('Form data:', formData); // Debugging log

        $.ajax({
            url: '{{ route("admin.saveFoodSelection") }}',
            method: 'POST',
            data: formData,
            success: function(response) {
                if (response.success) {
                    // Get the selected menu item name
                    var selectedMenuName = $('input[name="menu_id"]:checked').closest('div').find('div:first-child').text();

                    // Find the button that triggered the modal
                    var button = $('span[data-meal_id="' + response.savedMealPosition + '"]');

                    // Update the button text with the selected menu item name
                    button.text(response.savedMealPosition + selectedMenuName + '+');

                    alert('Selection saved successfully!');
                    $('#foodMenuModal').modal('hide');
                } else {
                    alert('Error saving selection.');
                }
            },
            error: function(xhr) {
                console.error('Error saving the selection:', xhr);
                alert('Error saving selection.');
            }
        });
    });

});





</script>
@endsection