<?php
	require 'database.php';

    class Query extends Database 
    {
        public function getData($table, $field='*', $condition_arr='' ,$or_condition_arr='' , $order_by_field='', $order_by_type='desc', $limit='')
        {
            try {
                $sql = "select $field from $table ";
                if ($condition_arr != '' && $or_condition_arr == '') {
                    $sql .= ' where ';
                    $c = count($condition_arr);	
                    $i = 1;
                    foreach ($condition_arr as $key=>$val) {
                        if ($i==$c) {
                            $sql .= "$key=:$key";
                        } else {
                            $sql .= "$key=:$key and ";
                        }
                        $i++;
                    }
                }
                if ($condition_arr != '' && $or_condition_arr != '') {
                    $sql .= ' where (';
                    $c = count($condition_arr);	
                    $i = 1;
                    foreach ($condition_arr as $key => $val) {
                        if ($i==$c) {
                            $sql .= "$key=:$key)";
                        } else {
                            $sql .= "$key=:$key and ";
                        }
                        $i++;
                    }
                    $sql .= ' or (';
                    $c = count($or_condition_arr);	
                    $i = 1;
                    foreach ($condition_arr as $key => $val) {
                        if ($i==$c) {
                            $sql .= "$key=:or$key)";
                        } else {
                            $sql .= "$key=:or$key and ";
                        }
                        $i++;
                    }
                }
                if ($order_by_field != '') {
                    $sql .= " order by $order_by_field $order_by_type ";
                }
                if ($limit!='') {
                    $sql .= " limit $limit ";
                }
                $statement = $this->connect()->prepare($sql);
                if ($condition_arr != '' && $or_condition_arr == '') {
                    foreach($condition_arr as $key => &$vale) {
                        $statement->bindParam($key, $vale);
                    }
                }
                if ($condition_arr != '' && $or_condition_arr != '') {
                    foreach($condition_arr as $key => &$valu) {
                        $statement->bindParam($key, $valu);
                    }
                    foreach($or_condition_arr as $key => &$val) {
                        $statement->bindParam('or'.$key, $val);
                    }
                }
                $statement->execute();
                $result = $statement->fetchAll(PDO::FETCH_ASSOC);
                if(count($result)) {
                    return $result;
                } else {
                    return 0;
                }
            } catch(Exception $e) {
                die($e->getMessage());
            }
        }
        
        public function insertData($table,$condition_arr) {
            try {
                if($condition_arr != '') {
                    foreach ($condition_arr as $key => $val) {
                        $fieldArr[] = $key;
                        $bindArr[] = ':'.$key;
                    }
                    $field = implode(",", $fieldArr);
                    $value = implode(",", $bindArr);
                    $sql= "insert into $table($field) values($value) ";
                    $statement = $this->connect()->prepare($sql);
                    foreach ($condition_arr as $key => &$val) {
                        $statement->bindParam($key, $val);
                    }
                    $statement->execute();
                }
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        
        public function deleteData($table, $id){
            try {
                $sql = "delete from $table where id = ?";
                $statement = $this->connect()->prepare($sql);
                $statement->bindParam(1, $id);
                $statement->execute();
            } catch (Exception $e) {
                die($e->getMessage());
            }
        }
        
        public function updateData($table, $condition_arr, $where_field, $where_value) {
            try{
                if ($condition_arr!='') {
                    
                    $_SESSION["sql"] = $condition_arr;
                    $sql="update $table set ";
                    $c=count($condition_arr);	
                    $i=1;
                    foreach ($condition_arr as $key => $val) {
                        if($i == $c) {
                            $sql .= $key." = :".$key." ";
                        } else {
                            $sql .= $key." = :".$key.", ";
                        }
                        $i++;
                    }
                    $sql .= " where id = :id";
                    $statement = $this->connect()->prepare($sql);
                    foreach ($condition_arr as $key=>&$val) {
                        $statement->bindParam($key, $val);
                    }
                    $statement->bindParam(':id', $where_value);
                    $statement->execute();
                }
            } catch(Exception $e) {
                die($e->getMessage());
            }
        }
    }