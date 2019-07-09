<?php

namespace App\Model;

use DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Base extends Model
{
    // 软删除
    use SoftDeletes;


    /**
     * 禁止被批量赋值的字段
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * 添加数据
     *
     * @param      $data   插入的内容
     * @return bool|mixed
     */
    public function storeData($data)
    {
        // 处理data为空的情况
        if (empty($data)) {
            return false;
        }
        //添加数据
        $result = $this->create($data);
        if ($result) {
            return $result->id;
        } else {
            return false;
        }
    }

    /**
     * 修改数据
     *
     * @param      $map   修改的where
     * @param      $data  修改的数据
     * @return bool
     */
    public function updateData($map, $data)
    {
        if (empty($map)) {
            return false;
        }

        if (empty($data)) {
            return false;
        }

        $model = $this
            ->whereMap($map)
            ->withTrashed()
            ->get();

        // 可能有查不到数据的情况
        if ($model->isEmpty()) {
            return false;
        }
        foreach ($model as $k => $v) {
            $result = $v->forceFill($data)->save();
        }
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 删除数据
     *
     * @param      $map   删除的where
     * @param      $data  删除的数据
     * @return bool
     */
    public function destroyData($map)
    {
        if (empty($map)) {
            return false;
        }

        // 软删除
        $result = $this
            ->whereMap($map)
            ->delete();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function addAll(Array $data)
    {
        $rs = DB::table($this->getTable())->insert($data);
        return $rs;
    }

    /**
     * 恢复数据
     *
     * @param      $map   恢复的数据where
     * @return bool恢复数据
     */
    public function restoreData($map)
    {
        if (empty($map)) {
            return false;
        }
        // 恢复
        $result = $this
            ->whereMap($map)
            ->restore();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 彻底删除
     *
     * @param      $map   彻底删除的数据where
     * @return bool
     */
    public function forceDeleteData($map)
    {
        if (empty($map)) {
            return false;
        }
        // 彻底删除
        $result = $this
            ->whereMap($map)
            ->forceDelete();
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    /**
     * 使用作用域扩展 Builder 链式操作
     * 示例:
     * $map = [
     *     'id' => ['in', [1,2,3]],
     *     'category_id' => ['<>', 9],
     *     'tag_id' => 10
     * ]
     *
     * @param $query
     * @param $map
     * @return mixed
     */
    public function scopeWhereMap($query, array $map)
    {
        // 如果是空直接返回
        if (empty($map)) {
            return $query;
        }
        // 判断关系是 and 还是 or
        $where = 'where';
        if (isset($map['_logic'])) {
            $logic = strtolower($map['_logic']);
            $where = $logic == 'or' ? 'orWhere' : 'where';
            unset($map['_logic']);
        }
        // 判断各种方法
        foreach ($map as $k => $v) {
            if (is_array($v)) {
                $sign = strtolower($v[0]);
                switch ($sign) {
                    case 'in':
                        $query->{$where . 'In'}($k, $v[1]);
                        break;
                    case 'notin':
                        $query->{$where . 'NotIn'}($k, $v[1]);
                        break;
                    case 'between':
                        $query->{$where . 'Between'}($k, $v[1]);
                        break;
                    case 'notbetween':
                        $query->{$where . 'NotBetween'}($k, $v[1]);
                        break;
                    case 'null':
                        $query->{$where . 'Null'}($k);
                        break;
                    case 'notnull':
                        $query->{$where . 'NotNull'}($k);
                        break;
                    case '=':
                    case '>':
                    case '<':
                    case '<>':
                    case 'like':
                        $query->{$where}($k, $sign, $v[1]);
                        break;
                }
            } else {
                $query->$where($k, $v);
            }
        }
        return $query;
    }

    /**
     * 批量更新的方法
     * 示例参数
     * $multipleData = [
     *    [
     *        'name' => 'name 1' ,
     *        'date' => 'date 1'
     *     ],
     *     [
     *        'name' => 'name 2' ,
     *        'date' => 'date 2'
     *      ]
     *   ]
     *
     * @param array $multipleData
     * @return bool|int
     */
    function updateBatch($multipleData = [])
    {
        if (empty($multipleData)) {
            return false;
        }
        // 获取表名
        $tableName = config('database.connections.mysql.prefix') . $this->getTable();
        $updateColumn = array_keys($multipleData[0]);
        $referenceColumn = $updateColumn[0];
        unset($updateColumn[0]);
        $whereIn = "";
        // 组合sql语句
        $sql = "UPDATE " . $tableName . " SET ";
        foreach ($updateColumn as $uColumn) {
            $sql .= $uColumn . " = CASE ";
            foreach ($multipleData as $data) {
                $sql .= "WHEN " . $referenceColumn . " = '" . $data[$referenceColumn] . "' THEN '" . $data[$uColumn] . "' ";
            }
            $sql .= "ELSE " . $uColumn . " END, ";
        }
        foreach ($multipleData as $data) {
            $whereIn .= "'" . $data[$referenceColumn] . "', ";
        }
        $sql = rtrim($sql, ", ") . " WHERE " . $referenceColumn . " IN (" . rtrim($whereIn, ', ') . ")";
        // 更新
        $result = DB::update(DB::raw($sql));
        return $result;
    }


}
