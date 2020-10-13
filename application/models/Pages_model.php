<?php
class Pages_model extends CI_Model {

    public function __construct()
    {
        parent::__construct();
        
        session_start();
    }

    private function query($sql, $parameters = []) 
    {
		$query = $this->pdo->prepare($sql);
		$query->execute($parameters);
		return $query;
    }

    private function queryBind($sql, $parameters = []) 
    {

        $data = [];
		foreach ($parameters as $key => $value) {
            $data[] = $value;
        }

		$query = $this->db->query($sql, $data);
		return $query;
    }

    public function find($table, $where = NULL, $orderBy = NULL, $order = 'ASC', $limit = NULL, $limitCount = NULL) 
    {
        if (!empty($where)) {
            foreach($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        if (!empty($orderBy)) {
            $this->db->order_by($orderBy, $order);
        }
        if (isset($limit)) {
            $query = $this->db->get($table, $limitCount, $limit);
        } else {        
            $query = $this->db->get($table);
        }
        return $query->result();
    }

    public function findCount($table, $where = NULL) 
    {
        if(!empty($where)) {
            foreach($where as $key => $value) {
                $this->db->where($key, $value);
            }
        }
        return $this->db->count_all_results($table);
    }

    public function findById($table, $value, $primaryKey = 'id') 
    {
		$query = 'SELECT * FROM `' . $table . '` WHERE `' . $primaryKey . '` = ?';

		$parameters = [
			'value' => $value
		];

		$query = $this->queryBind($query, $parameters);

		return $query->result();
	}

    private function insert($table, $fields) 
    {
		$query = 'INSERT INTO `' . $table . '` (';

		foreach ($fields as $key => $value) {
            $query .= '`' . $key . '`,';
		}

		$query = rtrim($query, ',');

		$query .= ') VALUES (';


		foreach ($fields as $key => $value) {
            $query .= '?,';
		}

		$query = rtrim($query, ',');

        $query .= ')';

		$fields = $this->processDates($fields);

		$this->queryBind($query, $fields);

		return $this->db->insert_id();
    }

    private function update($table, $fields, $primaryKey) 
    {
		$query = ' UPDATE `' . $table .'` SET ';

		foreach ($fields as $key => $value) {
            $query .= '`' . $key . '` = ?,';
        }
        
		$query = rtrim($query, ',');

		$query .= ' WHERE `' . $primaryKey . '` = ?';

		// :primaryKey 변수 설정
		$fields['primaryKey'] = $fields[$primaryKey];

		$fields = $this->processDates($fields);

		$this->queryBind($query, $fields);
    }

    public function delete($table, $id, $primaryKey = 'id') 
    {
        $parameters = [$primaryKey => $id];

		$this->queryBind('DELETE FROM `' . $table . '` WHERE `' . $primaryKey . '` = ?', $parameters);
    }
    
    public function deleteWhere($table, $parameters) 
    {
        $sql = 'DELETE FROM `' . $table . '` WHERE';
        
        foreach($parameters as $key => $value) {
            $sql .= ' `' . $key . '` = ? and';
        }
        $sql = rtrim($sql, ' and');

		$this->queryBind($sql, $parameters);
	}

    private function processDates($fields) 
    {
		foreach ($fields as $key => $value) {
			if ($value instanceof \DateTime) {
				$fields[$key] = $value->format('Y-m-d H:i:s');
			}
		}

		return $fields;
	}
    
    public function save($table, $record, $primaryKey = 'id') 
    {

		if (empty($record[$primaryKey])) {
            $insertId = $this->insert($table, $record);

            return $insertId;
		} else {
			$this->update($table, $record, $primaryKey);
		}
    }
    
    public function login($userid, $password)
    {
        $user = $this->getUser($userid);
        if (!empty($user) && password_verify($password, $user[0]->password)) {

            session_regenerate_id();
            $_SESSION['user'] = $user[0]->id;
            $_SESSION['userid'] = $userid;
            $_SESSION['password'] = $user[0]->password;
            $_SESSION['permission'] = $user[0]->permission;

            return true;
        } else {
            return false;
        }
    }

    public function isLoggedIn()
    {
        if (empty($_SESSION['userid'])) {
            return false;
        }

        $user = $this->getUser($_SESSION['userid']);

        if (!empty($user) && $user[0]->password === $_SESSION['password']) {
            return true;
        } else {
            return false;
        }
    }
    
    

    public function saveUpdate($version, $date, $datas) {
        $this->save('update', array('version' => $version, 'date' => $date, 'id' => $datas[0]['update_id']));
        foreach($datas as $key => $data) {
            $this->save('update_note', $data);
        }
    }

    public function deleteUpdate($post) {
        $this->delete('update', $post);
    }

    public function addUpdate() {
        $insertId = $this->save('update', array('version'=> '0.0.0'));

        return $insertId;
    }

    
    // 사용자
    public function saveUser($datas) {
        $this->save('author', $datas);
    }

    public function getUser($id) {
        return $this->find('author', array('userid' => $id));
    }

    public function getUserId($id) {
        return $this->findById('author', $id);
    }



    public function getCommunityPostList($pageNum = 0, $category = NULL, $user = NULL) {
        $where = array();
        if (!empty($user)) {
            $where['user'] = $user;
        }
        if (!empty($category)) {
            $where['category'] = $category;
        }
        echo $category;
        return $this->find('board',  $where, 'id', 'DESC', $pageNum, 15);
    }

    public function getCommunityPostListCount($category = NULL, $user = NULL) {
        $where = array();
        if (!empty($user)) {
            $where['user'] = $user;
        }
        if (!empty($category)) {
            $where['category'] = $category;
        }

        return $this->findCount('board', $where);
    }

    public function saveCommunityPost($datas) {
        return $this->save('board', $datas, 'id');
    }

    public function getCommunityPost($postId) {
        return $this->find('board', array('id' => $postId));
    }

    public function deleteCommunityPost($postId) {
        return $this->delete('board', array('id' => $postId));
    }

    public function saveComment($data) {
        return $this->save('comment', $data);
    }

    public function getCommunityComment($postId) {
        return $this->find('comment', array('post_id' => $postId));
    }

    public function getCommunityCategories() {
        return $this->find('category');
    }

    public function saveCommunityPostRecommand($postId, $recommand) {
        $this->save('recommand', array('userid' => $_SESSION['user'], 'post_id' => $postId, 'recommand' => $recommand));
    }

    public function getCommunityPostRecommandCount($postId) {
        $up = $this->findCount('recommand', array('post_id' => $postId, 'recommand' => 1));
        $down = $this->findCount('recommand', array('post_id' => $postId, 'recommand' => 0));
        return array('up' => $up, 'down' => $down);
    }

    public function getRecommand($postId, $recommand) {
        return $this->find('recommand', array('userid' => $_SESSION['user'], 'post_id' => $postId, 'recommand' => $recommand));
    }

    public function deleteCommunityPostRecommand($postId) {
        $this->deleteWhere('recommand', array('post_id' => (int)$postId, 'userid' => (int)$_SESSION['user']));
    }

    public function getPostRecommnadUser($postId) {
        return $this->find('recommand', array('post_id' => (int)$postId, 'userid' => (int)$_SESSION['user']));
    }

    public function getCategoryName($categoryId) {
        return $this->findById('category', $categoryId)[0]->name;
    }

    public function getCommentCount($postId) {
        return $this->findCount('comment', array('post_id' => $postId));
    }




    public function getFishes() {
        return $this->find('creature', array('type' => 1));
    }

    public function getInsects() {
        return $this->find('creature',array('type' => 0));
    }

    public function getSeaCreature() {
        return $this->find('creature',array('type' => 2));
    }


}