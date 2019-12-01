<?php
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;

class GuestbookPresenter extends Nette\Application\UI\Presenter
{
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }
    
    public function renderShow(): void
    {
        $comments = $this->database->table('comments')->order('date_added DESC');
        $this->template->comments = $comments;
    }

    protected function createComponentCommentForm(): Form
    {
        $form = new Form;

        $form->addText('name','')
            ->setRequired()
            ->setHtmlAttribute('placeholder','jméno')
            ->setHtmlAttribute('autocomplete','off');
        
        $form->addTextArea('comment','')
            ->setRequired()
            ->setHtmlAttribute('placeholder','komentář')
            ->setHtmlAttribute('class','editor')
            ->setHtmlAttribute('autocomplete','off');

        $form->addSubmit('send','Postnout');

        $form->getElementPrototype()->class = 'customCenter';

        $form->onSuccess[] = [$this, 'commentFormSuccess'];

        return $form;
    }

    public function commentFormSuccess(Form $form, \stdClass $values):void
    {
        $this->database->table('comments')->insert([
            'name' => $values->name,
            'comment' => strip_tags($values->comment),
        ]);

        $this->redirect('this');
    }
}