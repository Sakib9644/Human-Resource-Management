<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::all();

        return response()->json(['payrolls' => $payrolls]);
    }

    public function show(Payroll $payroll)
    {
        return response()->json(['payroll' => $payroll]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start_date' => 'required|date',
            'pay_period_end_date' => 'required|date|after_or_equal:pay_period_start_date',
            'basic_salary' => 'required|numeric',
            'overtime_pay' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $payroll = Payroll::create($request->all());

        return response()->json(['payroll' => $payroll], 201);
    }

    public function update(Request $request, Payroll $payroll)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start_date' => 'required|date',
            'pay_period_end_date' => 'required|date|after_or_equal:pay_period_start_date',
            'basic_salary' => 'required|numeric',
            'overtime_pay' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
            // Add other validation rules as needed
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $payroll->update($request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Department updated successfully',
            'data' => $payroll,
        ], 200);
    }

    

    public function destroy(Payroll $payroll)
    {
        $payroll->delete();

        return response()->json(['message' => 'Payroll deleted']);
    }
}
