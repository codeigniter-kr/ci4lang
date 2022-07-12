<?php
namespace ci4lang\Ci4lang;

use Rogervila\ArrayDiffMultidimensional;

use Jfcherng\Diff\Differ;
use Jfcherng\Diff\DiffHelper;
use Jfcherng\Diff\Factory\RendererFactory;
use Jfcherng\Diff\Renderer\RendererConstant;

class Ci4langClass
{
    private string $lang = 'ko';
    private string $ciPath;
    private string $langPath;
    private string $origin;
    private string $target;

    public function __construct(string $language='ko')
    {
        // * path
        $this->ciPath = SYSTEMPATH.'Language';
        $this->langPath = SYSTEMPATH.'../../translations/Language';

        // * default variables
        $this->lang = $language;
        $this->origin = $this->ciPath.'/en';
        $this->target = $this->langPath.'/'.$this->lang;
    }

    public function check()
    {
        // * helper load
        helper('filesystem');

        // * target path check
        if (is_dir($this->target) === false) {
            dd('There is no target translation pack.');
            return;
        }

        // * mapping
        $originMap = $this->variablesMapping($this->origin, 'origin');
        $targetMap = $this->variablesMapping($this->target);
        $diff = $this->mapDiffer($originMap, $targetMap);

        $this->diffTable($diff);
    }

    private function variablesMapping(string $path='', string $type='target')
    {
        $map = [];
        foreach ((directory_map($path)??[]) as $file) {
            $map[$file] = $this->getFileDocBlock($path.'/'.$file, $type);
        }
        return $map;
    }

    private function getFileDocBlock(string $file=null, string $type='target')
    {
        if ($file === null) {
            return [];
        }
        $docBlockTmp = [];
        $docBlock = [];
        $tokens = token_get_all(file_get_contents($file));
        foreach ($tokens as $k=>$v) {
            if (empty($v) || empty($v[2])) {
                continue;
            }
            if (in_array(token_name($v[0]), ['T_CONSTANT_ENCAPSED_STRING', 'T_COMMENT']) === false) {
                continue;
            }
            if (token_name($v[0]) === 'T_CONSTANT_ENCAPSED_STRING' && empty($docBlockTmp[$v[2]])) {
                $docBlockTmp[$v[2]] = [
                    'value' => $v[1],
                ];
            }

            if ($type == 'target') {
                if (token_name($v[0]) === 'T_COMMENT') {
                    $docBlockTmp[$v[2]]['comment'] = $v[1];
                }
            } else {
                if (token_name($v[0]) === 'T_CONSTANT_ENCAPSED_STRING') {
                    $docBlockTmp[$v[2]]['comment'] = $v[1];
                }
            }
        }
        foreach (($docBlockTmp??[]) as $k=>$v) {
            if (
                array_key_exists('value', $v) === false ||
                array_key_exists('comment', $v) === false
            ) {
                continue;
            }
            $name = str_replace(["'", '"'], '', $v['value']);
            $docBlock[$name] = [
                'value'=>trim(str_replace(['//', "'", '"'], '', ($v['comment']??''))),
                'line'=>$k,
            ];
        }

        return $docBlock;
    }

    private function mapDiffer(array $origin, array $target)
    {
        $diff = [];
        $check = ArrayDiffMultidimensional::compare($target, $origin);
        foreach (($check??[]) as $fileName=>$content) {
            $diff[$fileName] = [];
            foreach (($content??[]) as $variables=>$values) {
                $diff[$fileName][$variables] = [
                    'old'=>$values['value'],
                    'new'=>$origin[$fileName][$variables]['value']??'',
                ];
            }
        }

        return $diff;
    }

    private function diffTable(array $diff=[])
    {
        echo '
            <style>
                /* https://nanati.me/html_css_table_design/ */
                table {
                    width: 100%;
                    border-collapse: separate;
                    border-spacing: 0;
                    text-align: left;
                    line-height: 1.5;
                    border-top: 1px solid #ccc;
                    border-left: 1px solid #ccc;
                    margin : 20px 10px;
                }
                table th {
                    padding: 10px;
                    font-weight: bold;
                    vertical-align: top;
                    border-right: 1px solid #ccc;
                    border-bottom: 1px solid #ccc;
                    border-top: 1px solid #fff;
                    border-left: 1px solid #fff;
                    background: #eee;
                }
                table td {
                    padding: 10px;
                    vertical-align: top;
                    border-right: 1px solid #ccc;
                    border-bottom: 1px solid #ccc;
                }

                /**
                 * You can compile this by https://www.sassmeister.com with
                 *
                 * - dart-sass v1.18.0
                 */
                .diff-wrapper.diff {
                    background: repeating-linear-gradient(-45deg, whitesmoke, whitesmoke 0.5em, #e8e8e8 0.5em, #e8e8e8 1em);
                    border-collapse: collapse;
                    border-spacing: 0;
                    border: 1px solid black;
                    color: black;
                    empty-cells: show;
                    font-family: monospace;
                    font-size: 13px;
                    width: 100%;
                    word-break: break-all;
                }
                .diff-wrapper.diff th {
                    font-weight: 700;
                }
                .diff-wrapper.diff td {
                    vertical-align: baseline;
                }
                .diff-wrapper.diff td,
                .diff-wrapper.diff th {
                    border-collapse: separate;
                    border: none;
                    padding: 1px 2px;
                    background: #fff;
                }
                .diff-wrapper.diff td:empty:after,
                .diff-wrapper.diff th:empty:after {
                    content: " ";
                    visibility: hidden;
                }
                .diff-wrapper.diff td a,
                .diff-wrapper.diff th a {
                    color: #000;
                    cursor: inherit;
                    pointer-events: none;
                }
                .diff-wrapper.diff thead th {
                    background: #a6a6a6;
                    border-bottom: 1px solid black;
                    padding: 4px;
                    text-align: left;
                }
                .diff-wrapper.diff tbody.skipped {
                    border-top: 1px solid black;
                }
                .diff-wrapper.diff tbody.skipped td,
                .diff-wrapper.diff tbody.skipped th {
                    display: none;
                }
                .diff-wrapper.diff tbody th {
                    background: #cccccc;
                    border-right: 1px solid black;
                    text-align: right;
                    vertical-align: top;
                    width: 4em;
                }
                .diff-wrapper.diff tbody th.sign {
                    background: #fff;
                    border-right: none;
                    padding: 1px 0;
                    text-align: center;
                    width: 1em;
                }
                .diff-wrapper.diff tbody th.sign.del {
                    background: #fbe1e1;
                }
                .diff-wrapper.diff tbody th.sign.ins {
                    background: #e1fbe1;
                }
                .diff-wrapper.diff.diff-html {
                    white-space: pre-wrap;
                }
                .diff-wrapper.diff.diff-html.diff-combined .change.change-rep .rep {
                    white-space: normal;
                }
                .diff-wrapper.diff.diff-html .change.change-eq .old,
                .diff-wrapper.diff.diff-html .change.change-eq .new {
                    background: #fff;
                }
                .diff-wrapper.diff.diff-html .change .old {
                    background: #fbe1e1;
                }
                .diff-wrapper.diff.diff-html .change .new {
                    background: #e1fbe1;
                }
                .diff-wrapper.diff.diff-html .change .rep {
                    background: #fef6d9;
                }
                .diff-wrapper.diff.diff-html .change .old.none,
                .diff-wrapper.diff.diff-html .change .new.none,
                .diff-wrapper.diff.diff-html .change .rep.none {
                    background: transparent;
                    cursor: not-allowed;
                }
                .diff-wrapper.diff.diff-html .change ins,
                .diff-wrapper.diff.diff-html .change del {
                    font-weight: bold;
                    text-decoration: none;
                }
                .diff-wrapper.diff.diff-html .change ins {
                    background: #94f094;
                }
                .diff-wrapper.diff.diff-html .change del {
                    background: #f09494;
                }
            </style>
        ';
        foreach (($diff??[]) as $fileName=>$content) {
            echo '<h4>'.$fileName.'</h4>';
            echo '
                <table style="border:1px solid #ccc;">
                    <colgroup>
                        <col width="150">
                        <col width="200">
                        <col width="200">
                        <col>
                    </colgroup>
                    <thead>
                        <tr>
                            <th>key</th>
                            <th>old</th>
                            <th>new</th>
                            <th>diff</th>
                        </tr>
                    </thead>
                    <tbody>
            ';
            foreach (($content??[]) as $variables=>$values) {
                $jsonResult = DiffHelper::calculate($values['old'], $values['new'], 'Json'); // may store the JSON result in your database
                $htmlRenderer = RendererFactory::make('Combined', [
                    'detailLevel'=>'line',
                    'lineNumbers'=>false,
                    'showHeader'=>false,
                ]);
                $result = $htmlRenderer->renderArray(json_decode($jsonResult, true));
                echo '
                    <tr>
                        <th>'.$variables.'</th>
                        <td>'.$values['old'].'</td>
                        <td>'.$values['new'].'</td>
                        <td>'.$result.'</td>
                    </tr>
                ';
            }
            echo '
                    </tbody>
                </table>
            ';
        }
    }
}
