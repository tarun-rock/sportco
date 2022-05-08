<?php



use App\Model\UserRewards;
use Illuminate\Support\Facades\Auth;

function getTableData($table, $extra)
{

    $where = $extra["where"] ?? [];

    $orgTable = with(new $table)->getTable();

    if(empty($extra["na"]))
    {

        $where[$orgTable.".active"] = returnConfig("active");
    }

    $select = $extra["select"] ?? [];

    $single = $extra["single"] ?? 0;

    $query = $table::where($where);

    $joins = $extra["joins"] ?? [];

    $limit = $extra["limit"] ?? 0;

    $random = $extra["random"] ?? 0;

    $orderBy = $extra["order"] ?? [];

    $groupBy = $extra["group"] ?? [];

    $having = $extra["having"] ?? "";

    $whereNotIn  = $extra["whereNotIn"] ?? [];

    $whereIn  = $extra["whereIn"] ?? [];

    $whereNull  = $extra["whereNull"] ?? [];

    $whereOperand = $extra["whereOperand"] ?? [];

    $paginate = $extra["paginate"] ?? 0;

    $union = $extra["union"] ?? 0;

    if(!empty($joins))
    {

        foreach ($joins as $join)
        {

            $type = strtoupper($join['type']);

            $joiningTable = $join["alias"] ?? $join["table"];

            switch ($type){

                case "INNER":


                    $query->join($joiningTable, function ($internal) use ($join){

                        $internal->on($join["left_condition"],"=",$join["right_condition"]);
                        $internal->on($join['table'].".active", DB::raw(returnConfig("active")));

                        if(!empty($join["conditions"]))
                        {

                            foreach ($join["conditions"] as $key => $value)
                            {

                                $internal->on($key, DB::raw($value));

                            }

                        }


                    });

                    break;

                case "LEFT":

                    $query->leftJoin($joiningTable, function ($internal) use ($join){

                        $internal->on($join["left_condition"],"=",$join["right_condition"]);
                        $internal->on($join['table'].".active", DB::raw(returnConfig("active")));

                        if(!empty($join["conditions"]))
                        {

                            foreach ($join["conditions"] as $key => $value)
                            {

                                $internal->on($key, DB::raw($value));

                            }

                        }
                    });

                    break;

                case "RIGHT":

                    $query->rightJoin($joiningTable, function ($internal) use ($join){

                        $internal->on($join["left_condition"],"=",$join["right_condition"]);
                        $internal->on($join['table'].".active", DB::raw(returnConfig("active")));

                        if(!empty($join["conditions"]))
                        {

                            foreach ($join["conditions"] as $key => $value)
                            {

                                $internal->on($key, DB::raw($value));

                            }

                        }

                    });

                    break;

                default:

                    $query->join($joiningTable, function ($internal) use ($join){

                        $internal->on($join["left_condition"],"=",$join["right_condition"]);
                        $internal->on($join['table'].".active", DB::raw(returnConfig("active")));

                        if(!empty($join["conditions"]))
                        {

                            foreach ($join["conditions"] as $key => $value)
                            {

                                $internal->on($key, DB::raw($value));

                            }

                        }

                    });

                    break;
            }


        }


    }

    if(!empty($whereNotIn))
    {

        foreach ($whereNotIn as $key => $not)
        {

            $query->whereNotIn($key, $not);

        }

    }

    if(!empty($whereIn))
    {

        foreach ($whereIn as $key => $not)
        {

            $query->whereIn($key, $not);

        }

    }


    if(!empty($whereOperand))
    {

        foreach ($whereOperand as $where)
        {

            $query->where($where["column"], $where["operand"], $where["value"]);

        }


    }

    if(!empty($whereNull))
    {

        foreach ($whereNull as $null)
        {

            $query->whereNull($null);

        }

    }

    if(!empty($limit))
    {

        $query->limit($limit);

    }

    if(!empty($orderBy)) {

        foreach ($orderBy as $column => $order)
        {

            $query->orderBy($column, $order);

        }

    }

    if(!empty($random))
    {

        $query->inRandomOrder();

    }

    if(!empty($groupBy)) {

        foreach ($groupBy as $group)
        {

            $query->groupBy($group);

        }

    }

    if(!empty($having))
    {

        $query->havingRaw($having);

    }

    if(!empty($single))
    {

        $response = $query->first($select);

    }
    elseif(!empty($paginate))
    {

        $response = $query->select($select)->paginate($paginate);

    }
    else
    {

        $response = $query->get($select);

    }

    return $response;

}

function insertData($table, $extra)
{
    if(!empty($extra["id"]))
    {

        $status = $table::insertGetId($extra["data"]);

    }
    else
    {

        $status =  $table::insert($extra["data"]);

    }

    return $status;

}

function updateData($table, $extra)
{

    $where = $extra["where"] ?? [];

    $update = $extra["update"]  ?? [];

    $update["updated_at"] = currentTime();


    if(empty($extra["na"]))
    {

        $where["active"] = returnConfig("active");
    }

    $status = $table::where($where)->update($update);

    return $status;

}
