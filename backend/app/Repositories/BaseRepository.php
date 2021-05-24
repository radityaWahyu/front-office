<?php
namespace App\Repositories;

use App\Interfaces\BaseInterface;

class BaseRepository implements BaseInterface
{
    protected $modelClassName;

    public function create(array $attributes){
        try {
            $data = call_user_func_array("{$this->modelClassName}::create", array($attributes));
            $result = array('status' => true, 'message' => 'saved', 'data' => $data);
        } catch (Exception $e) {
            $result = array('status' => false, 'message' => $e, 'data' => null);
        }

        return $result;

    }
    public function get($data, array $columns){
        $limit = 1;

        $query = $this->modelClassName::select($columns);

        if(property_exists($data, 'relation')){
            $query = $query->with($data->relation);
        }

        if(property_exists($data ,'search')){
            $query = $query->where($data->search['field'],'like', '%'.$data->search['value'].'%');
        }

        if(property_exists($data, 'order')){
            $query = $query->orderBy($data->order['field'], $data->order['value']);
        } else {
            $query = $query->latest();
        }

        if(property_exists($data, 'get')){
            $query = $query->get();
        }else if(property_exists($data, 'paginate')){
            if(property_exists($data, 'limit')){
                $limit = $data->limit['value'];
            }

             $query = $query->paginate($limit);
        }


        return $query;

    }
    public function find($id, $column = array('*')){
        try {
            $data = call_user_func_array("{$this->modelClassName}::findOrFail", array($id, $column));
            $result = array('status' => true, 'message' => 'row_found', 'data' => $data);

          } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            $result = array('status' => false, 'message' => 'not_found', 'data' => null);
          } catch (Exception $e) {
            $result = array('status' => false, 'message' => $e, 'data' => null);

          }

          return $result;

    }
    public function update($id, array $attributes){
        try {
            $data = $this->modelClassName::where('id', $id)->update($attributes);
            $result = array('status' => true, 'message' => 'saved', 'data' => $data);
          } catch (Exception $e) {

            $result = array('status' => false, 'message' => $e, 'data' => null);
          }

        return $result;
    }
    public function delete($id){
        try {
            call_user_func_array("{$this->modelClassName}::destroy", array($id));

            $result = array('status' => true, 'message' => 'deleted');
        } catch(\Illuminate\Database\QueryException $e) {
           $result = array('status' => false, 'message' => $e->getMessage());
        }
        return $result;

    }
}