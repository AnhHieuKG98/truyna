<?php
namespace Admin;
class Controller_Banner extends \Controller_Backend {
  
  public $module_name = "banner";
  
  public function before(){
    parent::before();
    
    \Module::load($this->module_name);
    \Config::load($this->module_name.'::config'); #OK 
    \Lang::load($this->module_name.'::backend');
    
    $this->theme->get_template()->set('title', 'Banners');

    $form_buttons_data = array(
      "back_link"  => 'admin/banner'
    );
    $this->template->set_global('form_buttons', \View::forge("common/form_buttons",$form_buttons_data));

  }
  public function action_index()
  {

    if (\Input::method() == 'POST')
    {
      if(\Input::post("delete_selected")){
        $table_records = \Input::post("table_records");
        if(!empty($table_records)){
          
          $models = \Banner\Model_Banner::query()->where('id','in',$table_records)->get();
          
          foreach($models as $model){
            #\Banner\Model_Banner::find($bid)->delete();
            //xoá lang
            \Banner\Model_Banner_Lang::query()->where('banner_id', $model['id'])->delete();
            //xoá object
            $model->delete();
          }
          

          #\Banner\Model_Banner::query()->where('id','in',$table_records)->delete();
          \Response::redirect('admin/banner');
        }
      }#elseif(Input::post("update_form")){
        else{#chỉ cần enter hoặc bấm vào update form nhưng update form phải để đầu tiên
        $position = \Input::post("position");
        #print_r($position);exit;
        foreach($position as $obj=>$_position){
          $update = \Banner\Model_Banner::find($obj);
          $update->position = $_position;
          $update->save();
        }
        \Response::redirect('admin/banner');
      }
    }
    
    $params = \Input::get();
    
    $query = \Banner\Model_Banner::query()->order_by('position','asc');
    $query->related('lang',array("where"=>array(array("lang.lang_code"=>\Lang::get_lang()))));
    
    if(!empty($params['s'])){
      $s = $params['s'];
      $query->or_where_open();
      $query->where("lang.title","like","%$s%");
      $query->or_where_close();
    }
    
    if(!empty($params['status'])){
      $query->where("status","=",$params['status']);
    }
    $pagination = \Pagination::forge('pagination',array(
      'name' => 'bootstrap3',
      'total_items' => $query->count(),
      'uri_segment' => 'page',
      'per_page'       => $this->posts_per_page,
      #'uri_segment'    => 3,
    ),"bootstrap3");
    $query->rows_offset($pagination->offset)->rows_limit($pagination->per_page);
    $model = $query->get();

    #$model = \Banner\Model_Banner::find("all");
    
    foreach($model as &$m){
      $m->thumbnail = \Simage::get_image_size("banner",$m["id"],"b","A",120,80);
    }
    $data = array("model"=>$model);
    $this->template->set_global('pagination',$pagination,false);

    $this->theme->get_template()->set('title', 'Banners');
    $content = \View::forge('modules/banner/index', $data);
    $this->theme->get_template()->set('content', $content);

  }

  public function action_create()
  {
    $data = array();
    if (\Input::method() == 'POST')
    {
      $val = \Validation::forge();
      $val->add('title', 'Title')
          ->add_rule('required');
      $this->template->set_global('val', $val);
      if ($val->run())
      {
        $model = \Banner\Model_Banner::forge(array(
          #'title' => \Input::post('title'),
          #'summary' => \Input::post('summary'),
          'status' => \Input::post('status'),
          'position' => \Input::post('position'),
          'url' => \Input::post('url'),
          'module' => \Input::post('module'),
        ));
        if ($model and $model->save()){

          //save langs 
          $langs = fn_get_langs();
          foreach($langs as $lang){
            \Banner\Model_Banner_Lang::forge(array(
              'banner_id'       => $model->id,
              'lang_code'         => $lang,
              'title'             => \Input::post('title'),
              'title2'              => \Input::post('title2'),
              'summary'              => \Input::post('summary'),
            ))->save();
          }
          
          //save hình ảnh 
          cms_upload_image($model->id,$this->module_name);
          
          \Session::set_flash('success', e('Added banner #'.$model->id.'.'));
          $submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/banner');
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/banner/edit/'.$model->id);
        }else{
          \Session::set_flash('error', e('Could not save banner.'));
        }
      }else{
        \Session::set_flash('error', $val->error());
      }
    }
    $content = \View::forge('modules/banner/create',$data);
    $this->theme->get_template()->set('title', 'Add Banner');
    $this->theme->get_template()->set('content', $content);
  }

  public function action_edit($id)
  {
    $data = array();
    #$model = \Banner\Model_Banner::find($id);
    $model = \Banner\Model_Banner::find($id,array('related' => array(
          "lang"=>array(
            "where" => array(
              "lang_code" => \Lang::get_lang(),
            ),
          )
        )
      )
    );
    $model->image_main_grid = \Simage::get_image_size("banner",$model["id"],"b","A",120,80);
    $data["model"] = $model;
    if (\Input::method() == 'POST')
    {
      $val = \Validation::forge();
      $val->add('title', 'Title')
          ->add_rule('required');
      $this->template->set_global('val', $val);
      if ($val->run())
      {
        #$model->title = \Input::post('title');
        #$model->summary = \Input::post('summary');
        $model->status = \Input::post('status');
        $model->position = \Input::post('position');
        $model->url = \Input::post('url');
        $model->module = \Input::post('module');
        if ($model and $model->save()){

          //save lang 
          $query = \DB::update('banners_lang')->where("banner_id",$id)->where("lang_code",\Lang::get_lang());
          $query->set(array(
            'title' => \Input::post('title'),
            'title2' => \Input::post('title2'),
            'summary' => \Input::post('summary'),
          ))->execute();
          
          //save hình ảnh 
          cms_upload_image($id,$this->module_name);

          \Session::set_flash('success', e('Added banner #'.$model->id.'.'));
          $submit = \Input::post("submit");
          if($submit == "save_close"){
            \Response::redirect('admin/banner');
          }elseif($submit == "save"){
          }
          \Response::redirect('admin/banner/edit/'.$model->id);
        }else{
          \Session::set_flash('error', e('Could not save banner.'));
        }
      }else{
        \Session::set_flash('error', $val->error());
      }
    }
    $content = \View::forge('modules/banner/edit',$data);
    $this->theme->get_template()->set('title', 'Edit Banner');
    $this->theme->get_template()->set('content', $content);
  }

  public function action_delete($id)
  {
    if ($model = \Banner\Model_Banner::find($id)){
      //xoá langs 
      \DB::delete("banners_lang")->where("banner_id",$id)->execute();
      $model->delete();
      \Session::set_flash('success', l('Deleted banner #').$id);
    }else{
      \Session::set_flash('error', l('Could not delete banner #').$id);
    }
    \Response::redirect('admin/banner');
  }
}
