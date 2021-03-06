<?php
namespace CoreStore\interactors;
use CoreStore\interfaces\CategoryData;

class CategoryInteractor
{
	private $errors;
	private $data;

	public function __construct(CategoryData $data)
	{
		$this->data = $data;
	}

	public function getAllCategories()
	{
		return $this->data->getAll();
	}

	public function saveCategory($name)
	{
		if (empty($name)) {
			$this->errors[] = 'no_category_name';
		} else if ($this->data->categoryExists($name)) {
			$this->errors[] = 'category_exists';
		} else {
			$this->data->save($name);
		}
	}

	public function getLatestCategory()
	{
		return$this->data->getLast();
	}
	
	public function deleteCategory($id)
	{
		if (!is_int($id)) {
			$this->errors[] = 'id_not_int';
			return;
		} else if ($id <= 0) {
			$this->errors[] = 'zero_id';
			return;
		}
		$this->data->delete($id);
	}

	public function errors()
	{
		return $this->errors;
	}
}
