<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Hash;
use App\Shop\Entity\User;
use Illuminate\Support\Facades\Mail;
use App\Shop\Entity\Merchandise;

class MerchandiseController extends Controller
{

    public function MerchandiseCreateProcess()
    {
        $merchandise_data = [
            'status' => 'C',
            'name' => '',
            'name_en' => '',
            'introduction' => '',
            'introduction_en' => '',
            'photo' => '',
            'price' => 0,
            'remain_count' => 0,
        ];

        $merchandise_sql_data = Merchandise::create($merchandise_data);

        return redirect('/merchandise/' . $merchandise_sql_data['id'] . '/edit');
    }

    public function MerchandiseEditPage($merchandise_id)
    {
        $merchandises = Merchandise::where('id', $merchandise_id);
        if ($merchandises->count() === 0) {
            return redirect('/');
        } else {
            $merchandise = $merchandises->first();

            $binding = [
                'title' => '編輯商品',
                'merchandise' => $merchandise
            ];
            return view('merchandise.edit', $binding);
        }
    }

    public function MerchandiseEditProcess($merchandise_id)
    {
        $input = request()->all();

        unset($input['_token']);

        if (isset($input['photo'])) {
            // 有上傳圖片
            $photo = $input['photo'];
            // 檔案副檔名
            $file_extension = $photo->getClientOriginalExtension();
            print($file_extension);
            // 產生自訂隨機檔案名稱
            $file_name = uniqid() . '.' . $file_extension;
            // 檔案相對路徑
            $file_relative_path = 'images/merchandise/';
            // 檔案存放目錄為對外公開 public 目錄下的相對位置
            $file_path = public_path($file_relative_path);
            // 移動上傳檔案
            $photo->move($file_path, $file_name);
            // 設定存入資料庫的檔案路徑 是相對路徑
            $photo = $file_relative_path . $file_name;
        }

        Merchandise::where('id', $merchandise_id)
            ->update($input);

        dd($input);

        return redirect('/merchandise/' . $merchandise_id . '/edit');
    }
}
