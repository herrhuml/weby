<?php
declare(strict_types=1);
namespace App\Presenters;

use Nette;
use Nette\Application\UI\Form;


class PostPresenter extends Nette\Application\UI\Presenter
{
    /** @var Nette\Database\Context */
    private $database;

    public function __construct(Nette\Database\Context $database)
    {
        $this->database = $database;
    }

    public function renderShow(int $postId): void
    {
        $post = $this->database->table('posts')->get($postId);
        if(!$post){
            $this->error("no post was found");
        }
        $this->template->post = $post; 
        $this->template->comments = $post->related('comments')->order('created_at');
    }

    protected function createComponentCommentForm(): Form
    {
        $form = new Form; // Nette\Application\UI\Form
        
        $form->addText('name','Jméno:')
            ->setRequired()
            ->setHtmlAttribute('autocomplete','off');

        $form->addEmail('email','Email:')
            ->setHtmlAttribute('autocomplete','off');
            
        $form->addTextArea('content','Komentář')
            ->setRequired()
            ->setHtmlAttribute('class','editor')
            ->setHtmlAttribute('autocomplete','off');

        $form->addSubmit('send','Publikovat komentář');
        
        $form->getElementPrototype()->class = 'customCenter';
        
        $form->onSuccess[] = [$this, 'commentFormSuccess'];

        return $form;
    }

    public function commentFormSuccess(Form $form, \stdClass $values):void
    {
        $postId = $this->getParameter('postId');

        $this->database->table('comments')->insert([
            'post_id' => $postId,
            'name' => $values->name,
            'email' => $values->email,
            'content' => strip_tags($values->content),
        ]);

        $this->flashMessage('Thanks for the comment','success');
        $this->redirect('this');
    }
}