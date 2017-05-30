<?php

Route::resource('employee', 'EmployeeController');

Route::get('/', function () {
    return view('employee.create');
});
