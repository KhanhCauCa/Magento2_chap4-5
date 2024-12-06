<?php
namespace Magenest\Movie\Controller\Index;

class Index extends \Magento\Framework\App\Action\Action
{
    protected $movieFactory;
    protected $directorFactory;
    protected $actorFactory;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magenest\Movie\Model\MovieFactory $movieFactory,
        \Magenest\Movie\Model\DirectorFactory $directorFactory,
        \Magenest\Movie\Model\ActorFactory $actorFactory
    )
    {
        parent::__construct($context);
        $this->movieFactory = $movieFactory;
        $this->directorFactory = $directorFactory;
        $this->actorFactory = $actorFactory;
    }

    public function execute()
    {
        $movies = $this->movieFactory->create()->getCollection();
        $output = '';
        foreach ($movies as $movie) {
            $director = $this->directorFactory->create()->load($movie->getDirectorId());
            $actors = $this->actorFactory->create()->getCollection()->addFieldToFilter('actor_id', ['in' => $movie->getActorIds()]);
            $output .= '<h2>' . $movie->getName() . '</h2>';
            $output .= '<p>Director: ' . $director->getName() . '</p>';
            $output .= '<p>Actors: ';
            foreach ($actors as $actor) {
                $output .= $actor->getName() . ' ';
            }
            $output .= '</p>';
        }
        $this->getResponse()->setBody($output);
    }
}
