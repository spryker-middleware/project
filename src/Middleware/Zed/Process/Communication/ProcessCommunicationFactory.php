<?php
namespace Middleware\Zed\Process\Communication;

use Generated\Shared\Transfer\IteratorSettingsTransfer;
use Generated\Shared\Transfer\ProcessSettingsTransfer;
use League\Pipeline\FingersCrossedProcessor;
use Middleware\Zed\Process\Business\Pipeline\Pipeline;
use Middleware\Zed\Process\Business\Pipeline\PipelineInterface;
use Middleware\Zed\Process\Business\Pipeline\Stage\Stage;
use Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface;
use Middleware\Zed\Process\Business\Process\Process;
use Middleware\Zed\Process\ProcessDependencyProvider;
use Middleware\Zed\Stage\Business\Iterator\CsvIterator;
use Spryker\Zed\Kernel\Communication\AbstractCommunicationFactory;

/**
 * @method \Middleware\Zed\Process\ProcessConfig getConfig()
 */
class ProcessCommunicationFactory extends AbstractCommunicationFactory
{
    /**
     * @param \Generated\Shared\Transfer\ProcessSettingsTransfer $processSettingsTransfer
     *
     * @return \Middleware\Zed\Process\Business\Process\ProcessInterface
     */
    public function createProcess(ProcessSettingsTransfer $processSettingsTransfer)
    {
        return new Process(
            $this->getProcessIterator($processSettingsTransfer),
            $this->createPipeline($this->getStagePluginsListForProcess($processSettingsTransfer->getName()))
        );
    }

    /**
     * @param string $processName
     *
     * @return array
     */
    protected function getStagePluginsListForProcess($processName):array
    {
        $stages = $this->getProvidedDependency(ProcessDependencyProvider::MIDDLEWARE_PROCESS_STAGES);
        return $stages[$processName];
    }

    /**
     * @param \Generated\Shared\Transfer\ProcessSettingsTransfer $processSettingsTransfer
     *
     * @return \Iterator
     */
    protected function getProcessIterator($processSettingsTransfer)
    {
        $iterators = $this->getProcessIteratorsList();
        return $iterators[$processSettingsTransfer->getName()]($processSettingsTransfer->getIteratorSettings());
    }

    /**
     * @return array
     */
    protected function getProcessIteratorsList()
    {
        return [
            ProcessDependencyProvider::PRODUCT_IMPORT_PROCESS => function(IteratorSettingsTransfer $iteratorSettingsTransfer) {
                return $this->createProductImportIterator($iteratorSettingsTransfer);
            }
        ];
    }

    /**
     * @param \Generated\Shared\Transfer\IteratorSettingsTransfer
     *
     * @return \Iterator
     */
    protected function createProductImportIterator($iteratorSettingsTransfer)
    {
        return new CsvIterator($this->getConfig()->getProductImportPath(), $iteratorSettingsTransfer);
    }

    /**
     * @param \Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface[] $stagePlugins
     *
     * @return \Middleware\Zed\Process\Business\Pipeline\PipelineInterface
     */
    public function createPipeline(array $stagePlugins)
    {
        return new Pipeline(
            $this->createPipelineProcessor(),
            $this->getStages($stagePlugins)
        );
    }

    /**
     * @param \Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface[] $stagePlugins
     *
     * @return \Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface[]
     */
    protected function getStages(array $stagePlugins)
    {
        $stages = [];
        foreach ($stagePlugins as $stagePlugin) {
            $stages[] = $this->createStage($stagePlugin);
        }

        return $stages;
    }

    /**
     * @param \Middleware\Zed\Process\Business\Pipeline\StagePlugin\StagePluginInterface $stagePlugin
     *
     * @return \Middleware\Zed\Process\Business\Pipeline\Stage\StageInterface
     */
    protected function createStage(StagePluginInterface $stagePlugin)
    {
        return new Stage($stagePlugin);
    }

    /**
     * @return \League\Pipeline\FingersCrossedProcessor
     */
    public function createPipelineProcessor()
    {
        return new FingersCrossedProcessor();
    }
}
