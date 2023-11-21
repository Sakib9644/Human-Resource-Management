<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Payroll;
use Illuminate\Http\Request;

class PayrollController extends Controller
{
    public function index()
    {
        $payrolls = Payroll::all();

        return response()->json(['payrolls' => $payrolls]);
    }

    public function show($id)
    {
        $payroll = Payroll::find($id);

        if (!$payroll) {
            return response()->json(['error' => 'Payroll not found'], 404);
        }

        return response()->json(['payroll' => $payroll]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'pay_period_start_date' => 'required|date',
            'pay_period_end_date' => 'required|date|after_or_equal:pay_period_start_date',
            'basic_salary' => 'required|numeric',
            'overtime_pay' => 'nullable|numeric',
            'deductions' => 'nullable|numeric',
            'net_salary' => 'required|numeric',
        ]);

        $payroll = Payroll::create($request->all());

        return response()->json(['payroll' => $payroll], 201);
    }

    public function update(Request $request, $id)
    {
        $payroll = Payroll::find($id);

        if (!$payroll) {
            return response()->json(['error' => 'Payroll not found'], 404);
        }

        $request->validate([
            'employee_id' => 'sometimes|required|exists:employees,id',
            'pay_period_start_date' => 'sometimes|required|date',
            'pay_period_end_date' => 'sometimes|required|date|after_or_equal:pay_period_start_date',
            'basic_salary' => 'sometimes|required|numeric',
            'overtime_pay' => 'sometimes|nullable|numeric',
            'deductions' => 'sometimes|nullable|numeric',
            'net_salary' => 'sometimes|required|numeric',
        ]);

        $payroll->update($request->all());

        return response()->json(['payroll' => $payroll]);
    }

    public function destroy($id)
    {
        $payroll = Payroll::find($id);

        if (!$payroll) {
            return response()->json(['error' => 'Payroll not found'], 404);
        }

        $payroll->delete();

        return response()->json(['message' => 'Payroll deleted']);
    }
}
