<?php


namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\ModelRepositories\PayrollRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\JsonResponse;

class PayrollController extends Controller
{
    protected $payrollObject;

    public function __construct(PayrollRepository $payrollRepository)
    {
        $this->payrollObject = $payrollRepository;
    }

    public function index()
    {
        $payrolls = $this->payrollObject->all();

        return response()->json(['payrolls' => $payrolls]);
    }

    public function show($id)
    {
        $payroll = $this->payrollObject->find($id);

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

        $payroll = $this->payrollObject->create($request->all());

        return response()->json(['payroll' => $payroll], 201);
    }

    public function edit($id)
    {
        $payroll = $this->payrollObject->find($id);

        return response()->json(['payroll' => $payroll], 200);
    }

    public function update(Request $request, $id)
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

        $payroll = $this->payrollObject->update($id, $request->all());

        return response()->json([
            'status' => 'success',
            'message' => 'Payroll updated successfully',
            'data' => $payroll,
        ], 200);
    }

    public function destroy($id)
    {
        $this->payrollObject->delete($id);

        return response()->json(['message' => 'Payroll deleted']);
    }
}
