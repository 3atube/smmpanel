<?php

namespace App\Http\Controllers\Admin\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Setting, App\Model\Admin, App\Model\Addtocard;
use Illuminate\Support\Facades\Hash;
use App\Libraries\Helpers;
use Illuminate\Support\Str;
use App\User;
use Auth, DB, File, Image, Redirect, Cache;
use App\Exports\CustomerExport;
use App\Exports\OrderExport;
use Maatwebsite\Excel\Facades\Excel;
use WebService;
use Carbon\Carbon;
use Validator;
use Response;
use App\Model\Provider;
use App\Repositories\Provider\ProviderRepositoryInterface;
use App\Repositories\Category\CategoryRepositoryInterface;
use App\Repositories\Service\ServiceRepositoryInterface;


class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $providerRepository;
    private $categoryRepository;
    private $serviceRepository;
    public function __construct(ProviderRepositoryInterface $providerRepository,
        ServiceRepositoryInterface $serviceRepository, CategoryRepositoryInterface $categoryRepository){
        $this->providerRepository = $providerRepository;
        $this->categoryRepository = $categoryRepository;
        $this->serviceRepository = $serviceRepository;
    }

    public function disableCategory($id){
        $info = $this->categoryRepository->find($id);
        $info->update(['category_type'=> 1]);
        return redirect()->route('admin.services');
    }

    public function activeCategory($id){
        $info = $this->categoryRepository->find($id);
        $info->update(['category_type'=> 2]);
        return redirect()->route('admin.services');
    }
    


    public function categorySortable($data){
        $categories = $data['categories'];
        foreach($categories as $item){
            $info = $this->categoryRepository->find($item['id']);
            $info->update(['category_line' => $item['line']]);
            Helpers::updateCategoryLine($item['id'], $item['line']);
        }
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function addView(){
        $viewRender = view('admin-view.category.add')->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Create new category',
        ]);
    }

    public function store(Request $request){
        $validation_rules = array(
            'secret' => 'required|max:255',
            'name' => 'required|max:255',
        );
        $messages = array(
            'name.required' => 'Category name cannot be empty',
            'secret.required' => 'Personal Category cannot be empty',
        );
        $validator = Validator::make($request->all(), $validation_rules, $messages);
        if($validator->fails()) {
            return response()->json([
                'm' => $validator->messages(),
                's' => 'error',
                'r' => null,
                't' => "error",
                'time' => 1
            ]);
        }
        $name = $request->name;
        $secret = $request->secret;
        $categoryLine = $this->categoryRepository->getCategoryLine();

        $params =[
            'category_name' => $name,
            'category_secret'    => $secret,
            'desc'   => null,
            'category_line'  => $categoryLine,
            'status' =>1
        ];
        $this->categoryRepository->create($params);
        return response()->json([
                'r' => route('admin.services'),
                'm' => 'Transaction successful',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function editView($id){
        $info = $this->categoryRepository->find($id);
        $viewRender = view('admin-view.category.edit', compact('info'))->render();
        return response()->json([
            'content' => $viewRender,
            'title' => 'Edit category('.$info->name.')',
        ]);
    }

    public function update($id, Request $request){
        $info = $this->categoryRepository->find($id);
        $info->update($request->all());
        return response()->json([
                'r' => route('admin.services'),
                'm' => 'Update thành công',
                's' => 'success',
                't' => "error",
                'time' => 1
            ]);
    }

    public function destroy($id){
        $this->categoryRepository->delete($id);
        $this->serviceRepository->removeByCategory($id);
        return redirect()->route('admin.services');
    }
}
