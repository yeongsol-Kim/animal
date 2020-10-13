<?php

class Community extends CI_Controller {

    private $users;
    private $usernameColumn;
    private $passwordColumn;

    public function __construct()
    {
        parent::__construct();
        $this->load->helper('url');
        $this->load->model('Pages_model');
        date_default_timezone_set('Asia/Seoul');
    }

    private function view($page = 'home', $data = null)
    {
        if (!file_exists(APPPATH.'views/pages/' . $page . '.php'))
        {
            show_404();
        }

        $data['isLoggedIn'] = $this->Pages_model->isLoggedIn();

        $this->load->view('templates/header', $data);
        $this->load->view('pages/'. $page, $data);
        $this->load->view('templates/footer', $data);
    }

    private function error($title, $message = "권한이 없습니다.") {
        $data['title'] = $title;
        $data['message'] = $message;
        $data['scripts'][0] = '';

        $this->view('error', $data);
    }


    public function login()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userid', '아이디', 'trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', '비밀번호', 'trim|required');

        if ($this->form_validation->run())
        {
            if (!empty($_POST['userid']) && $this->Pages_model->login($_POST['userid'], $_POST['password'])) {
                redirect('/pages');
            } else {
                $page = 'login'; 
                $data['title'] = '로그인';
                $data['scripts'][0] = '';

                $this->view($page, $data);
            }
        } else {
            $page = 'login'; 
            $data['title'] = '로그인';
            $data['scripts'][0] = '';

            $this->view($page, $data);
        }
    }

    public function logout()
    {
        unset($_SESSION);
        session_destroy();
        redirect('/pages');
    }

    public function register()
    {
        $this->load->helper(array('form', 'url'));
        $this->load->library('form_validation');

        $this->form_validation->set_rules('userid', '아이디', 'callback_useridCheck|trim|required|min_length[5]|max_length[12]');
        $this->form_validation->set_rules('password', '비밀번호', 'trim|required');
        $this->form_validation->set_rules('password_confirm', '비밀번호 확인', 'trim|required|matches[password]');
        $this->form_validation->set_rules('nickname', '닉네임', 'trim|required');


        if ($this->form_validation->run())
        {
            $page = 'registerSuccess'; 
            $data['title'] = '로그인성공';
            $data['scripts'][0] = '';
            

            $author = array('userid' => $_POST['userid'], 'password' => password_hash($_POST['password'], PASSWORD_DEFAULT), 'name' => $_POST['nickname']);
            $this->Pages_model->saveUser($author);


            $this->view($page, $data);
        } else {
            $page = 'register'; 
            $data['title'] = '회원가입';
            $data['scripts'][0] = '';
            
            $this->view($page, $data);
        }
    }

    public function useridCheck($userid) 
    {
        $user = $this->Pages_model->getUser(strtolower($userid));
        if (empty($user)) {
            return true; 
        } else {
            return false;
        }

    }

    // 커뮤니티
    public function community($category = NULL)
    {
        if (!empty($_GET['userid'])) {
            $data['postList'] = $this->Pages_model->getCommunityPostList($_GET['userid']);
        } else {
            $data['postList'] = $this->Pages_model->getCommunityPostList();
        }

        foreach($data['postList'] as $post) {
            $data['username'][$post->user] = $this->Pages_model->getUserId($post->user)[0]->name;
        }
        
        $data['categories'] = $this->Pages_model->getCommunityCategories();
        foreach($data['categories'] as $cate) {
            $data['categoryName'][$cate->id] = $cate->name;
        }
        
        $data['category'] = $category;
        $data['title'] = '도감';
        $data['scripts'][0] = '';
        $page = 'community';
        $this->view($page, $data);
    }

    public function communityPost($postId)
    {
        $data['post'] = $this->Pages_model->getCommunityPost($postId);
        $userRecommand = $this->Pages_model->getPostRecommnadUser($postId);
        
        $data['userRecommand'] = 2;
        if(!empty($userRecommand)) {
            $data['userRecommand'] = $userRecommand[0]->recommand;
        }
        
        if (!empty( $data['post'][0]->id)) {
            $data['comments'] = $this->Pages_model->getCommunityComment($postId);
            $data['categories'] = $this->Pages_model->getCommunityCategories();
            $data['recommand'] = $this->Pages_model->getCommunityPostRecommandCount($postId);

            if (!empty($data['comments'])) {
                foreach($data['comments'] as $comment) {
                    $data['users'][$comment->user] = $this->Pages_model->getUserId($comment->user);
                }
            }

            $data['title'] = '커뮤니티 - ' . $data['post'][0]->title;
            $data['scripts'][0] = 'communityPost';
            
            $this->view('communityPost', $data);
        } else {
            $data['title'] = '글이 존재하지 않습니다.';
            $data['scripts'][0] = '';
            $data['message'] = '해당 글이 삭제되었거나 존재하지 않습니다.';
            $this->view('error', $data);
        }
    }

    public function communityPostEdit($postId = NULL)
    {
        if ($this->Pages_model->isLoggedIn()) {
            $data['postData'] = $this->Pages_model->getCommunityPost($postId);

            if (!empty($_POST['board'])) {
                $this->load->helper(array('form', 'url'));
                $this->load->library('form_validation');

                $this->form_validation->set_rules('board[title]', '제목', 'trim|required|max_length[30]');
                $this->form_validation->set_rules('board[contents]', '글', 'trim|required');
                $this->form_validation->set_rules('board[category]', '카테고리', 'required');

                if ($this->form_validation->run()) {
                    $dbData = $_POST['board'];
                    $dbData['datetime'] = date("Y-m-d H:i:s", time());

                    if (!empty($postId)) {
                        if($data['postData'][0]->user == $_SESSION['user'] || $_SESSION['permission'] == 1) {
                            $dbData['id'] = $postId;
                            $this->Pages_model->saveCommunityPost($dbData);
                        }
                    } else {
                        $dbData['user'] = $_SESSION['user'];
                        $postId = $this->Pages_model->saveCommunityPost($dbData);
                    }
                }
                redirect('pages/communityPost/' . $postId);
            } else {
                if (!empty($postId)) {
                    if ($data['postData'][0]->user == $_SESSION['user'] || $_SESSION['permission'] == 1) {
                        $data['categories'] = $this->Pages_model->find('category');
                    } else {
                        $this->error('페이지 오류', '해당 글을 수정할 권한이 없습니다');
                        return 0;
                    }
                }
                $data['categories'] = $this->Pages_model->find('category');
                $data['title'] = '게시글 작성';
                $data['scripts'][0] = 'communityPostEdit';
                $this->view('communityPostEdit', $data);
            }
        } else {
            $this->error('페이지 오류', '로그인이 되어있지 않습니다. <br/>로그인후 다시 시도해주세요.');
        }
    }

    public function communityPostDelete($postId)
    {
        if ($this->Pages_model->isLoggedIn()) {
            if (!empty($this->Pages_model->getCommunityPost($postId)[0]->user)) {
                if ($this->Pages_model->getCommunityPost($postId)[0]->user == $_SESSION['user'] || $_SESSION == 1) {
                    $this->Pages_model->deleteCommunityPost($postId);
                    redirect('/pages/community');
                } else {
                    $this->error('권한 오류', '글을 삭제할 권한이 없습니다.');
                }
            } else {
                $this->error('접근 오류', '글이 이미 삭제되었거나 존재하지 않습니다.');
            }
        } else {
            $this->error('로그인 오류', '로그인이 되어있지 않습니다.<br/>글을 삭제하시려면 로그인 후에 시도해주세요');
        }
    }

    
    public function communityPostRecommand($postId, $recommnad)
    {
        if ($this->Pages_model->isLoggedIn()) {

            if(empty($this->Pages_model->getRecommand($postId, $recommnad))) {
                $this->Pages_model->deleteCommunityPostRecommand($postId);
                $this->Pages_model->saveCommunityPostRecommand($postId, $recommnad);
            } else {
                $this->Pages_model->deleteCommunityPostRecommand($postId);
            }
            
            redirect('/pages/communityPost/' . $postId);
        } else {
            redirect('/pages/login');
        }
    }


    public function commentAdd($postId)
    {
        if ($this->Pages_model->isLoggedIn()) {
            $data = $_POST['comment'];
            $data['post_id'] = $postId;
            $data['datetime'] = date("Y-m-d H:i:s", time());
            $this->Pages_model->saveComment($data);
            header('location:' . $_SERVER['HTTP_REFERER']);
        } else {
            redirect('Pages/login');
        }
    }



    public function aa($page = 'getMonthCode')
    {
        $data['title'] = '도감';
        $data['scripts'][0] = 'getMonth';
        $this->view($page, $data);
    }
}