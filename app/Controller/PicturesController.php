<?php
App::uses('AppController', 'Controller');
/**
 * Pictures Controller
 *
 * @property Picture $Picture
 * @property PaginatorComponent $Paginator
 */
class PicturesController extends AppController {

/**
 * Components
 *
 * @var array
 */
	public $components = array('Paginator');

/**
 * index method
 *
 * @return void
 */
	public function index($albumId = null) {
		$this->Picture->recursive = 0;
		$options = array('conditions' => array('Picture.album_id' => $albumId));
		$this->set('pictures', $this->Picture->find('all', $options));
	}

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Picture->exists($id)) {
			throw new NotFoundException(__('Invalid picture'));
		}
		$options = array('conditions' => array('Picture.' . $this->Picture->primaryKey => $id));
		$this->set('picture', $this->Picture->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		debug($this->request->data);
		if ($this->request->is('post')) {
			$this->Picture->create();

			$picture = $this->request->data["Picture"]["content"];
         	
         	if($picture["size"] > 0){
            	$fileData = fread(fopen($picture["tmp_name"], "r"), $picture["size"]);
            	$this->request->data["Picture"]["content"] = $fileData;
         	}else{
            	$this->request->data["Picture"]["content"] = null;
         	}

			if ($this->Picture->save($this->request->data)) {
				$this->Session->setFlash(__('The picture has been saved.'));
				return $this->redirect(array('action' => 'index', $this->request->data['Picture']['album_id']));
			} else {
				$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			}
		}
		$albums = $this->Picture->Album->find('list');
		$this->set(compact('albums'));
	}

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Picture->exists($id)) {
			throw new NotFoundException(__('Invalid picture'));
		}
		if ($this->request->is(array('post', 'put'))) {
			if ($this->Picture->save($this->request->data)) {
				$this->Session->setFlash(__('The picture has been saved.'));
				return $this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The picture could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Picture.' . $this->Picture->primaryKey => $id));
			$this->request->data = $this->Picture->find('first', $options);
		}
		$albums = $this->Picture->Album->find('list');
		$this->set(compact('albums'));
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Picture->id = $id;
		if (!$this->Picture->exists()) {
			throw new NotFoundException(__('Invalid picture'));
		}

		$album = $this->Picture->find('first', array('conditions' => array('Picture.id' => $id)));

		$this->request->onlyAllow('post', 'delete');
		if ($this->Picture->delete()) {
			$this->Session->setFlash(__('The picture has been deleted.'));
		} else {
			$this->Session->setFlash(__('The picture could not be deleted. Please, try again.'));
		}
		return $this->redirect(array('action' => 'index', $album['Album']['id']));
	}}
