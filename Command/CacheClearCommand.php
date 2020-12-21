<?php

declare(strict_types=1);

namespace KPhoen\RulerZBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Clear the cache.
 *
 * @author Kévin Gomez <contact@kevingomez.fr>
 */
class CacheClearCommand extends Command
{
    private $cacheDir;
    private $filesystem;

    public function __construct($cacheDir, $filesystem)
    {
        $this->cacheDir = $cacheDir;
        $this->filesystem = $filesystem;

        parent::__construct();
    }

    /**
     * {@inheritdoc}
     */
    protected function configure()
    {
        $this
            ->setName('rulerz:cache:clear')
            ->setDescription("Clear RulerZ's cache")
        ;
    }

    /**
     * {@inheritdoc}
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        if (!is_writable($this->cacheDir)) {
            throw new \RuntimeException(sprintf('Unable to write in the "%s" directory', $this->cacheDir));
        }

        if ($this->filesystem->exists($this->cacheDir)) {
            $this->filesystem->remove($this->cacheDir);
            $this->filesystem->mkdir($this->cacheDir);
        }
    }
}
