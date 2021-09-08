<?php

namespace App\Helpers;

class Template
{
    public static function showButtonFilter()
    {
        return ' <a href="?filter_status=all" type="button" class="btn btn-primary">All <span class="badge bg-white">4</span>
                                </a><a href="?filter_status=active"
                                       type="button" class="btn btn-success">
                                    Active <span class="badge bg-white">2</span>
                                </a><a href="?filter_status=inactive"
                                       type="button" class="btn btn-success">
                                    Inactive <span class="badge bg-white">2</span>
                                </a>';
    }

    public static function showButtonSearch()
    {
        return '                                <div class="input-group">
                                    <div class="input-group-btn">
                                        <button type="button"
                                                class="btn btn-default dropdown-toggle btn-active-field"
                                                data-toggle="dropdown" aria-expanded="false">
                                            Search by All <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                            <li><a href="#"
                                                   class="select-field" data-field="all">Search by All</a></li>
                                            <li><a href="#"
                                                   class="select-field" data-field="id">Search by ID</a></li>
                                            <li><a href="#"
                                                   class="select-field" data-field="username">Search by Username</a>
                                            </li>
                                            <li><a href="#"
                                                   class="select-field" data-field="fullname">Search by Fullname</a>
                                            </li>
                                            <li><a href="#"
                                                   class="select-field" data-field="email">Search by Email</a></li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control" name="search_value" value="">
                                    <span class="input-group-btn">
                                    <button id="btn-clear" type="button" class="btn btn-success"
                                            style="margin-right: 0px">Xóa tìm kiếm</button>
                                    <button id="btn-search" type="button" class="btn btn-primary">Tìm kiếm</button>
                                    </span>
                                    <input type="hidden" name="search_field" value="all">
                                </div>';
    }

    public static function showTitleTable($controllerName){
        $tmplTitle = config('utils.template.titleInAreaTable');
        $titleInArea = config('utils.config.titleInAreaTable');
        $controllerName = (array_key_exists($controllerName, $titleInArea)) ? $controllerName : 'default';

        $xhtml = '<tr class="headings">';
        $listTile = $titleInArea[$controllerName];
        foreach ($listTile as $title){
            $currentTitle = $tmplTitle[$title];
            $xhtml.= sprintf('<th class="column-title">%s</th>', $currentTitle['name']);
        }
        $xhtml .= '</tr>';

        return $xhtml;

    }
    public static function showItemThumb($controlerName, $thumbName, $thumbAlt)
    {
        $srcName = 'admin/img/' . $controlerName . '/' . $thumbName;
        $xhtml = sprintf (
            '<img src=" %s" alt=" %s" class="zvn-thumb">',asset ( $srcName), $thumbAlt);
        return $xhtml;
    }
    public static function showItemStatus($controllerName, $id, $status)
    {
        $tmplStatus = config ('utils.template.status');
        //kiểm tra xem status truyền vào có nằm trong key của array tmlStatus ko
        $statusValue = array_key_exists ($status, $tmplStatus) ? $status : 'default';
        $currentTemplateStatus = $tmplStatus[$statusValue];
//        $link = route ($controllerName . '/status', ['status' => $status, 'id' => $id]);
        $link = "#";
        $xhtml = sprintf ('<a href="%s" type="button" class="btn btn-round %s"> %s</a>', $link, $currentTemplateStatus['class'], $currentTemplateStatus['name']);
        return $xhtml;

    }
    public static function showItemHistory($by, $time)
    {
        //sprintf():Viết chuỗi được định dạng thành biến
        $xhtml = sprintf (
            '<p><i class="fa fa-user"></i> %s</p>
                    <p><i class="fa fa-clock-o"></i> %s</p>', $by, date ((config ('utils.format.short_time')),strtotime ($time)));

        return $xhtml;
    }

    public static function showButtonAction($controllerName, $id)
    {
        //thu 1: dat cac properties
        $tmplButton = config('utils.template.button');
        // thu 2 : neu slider thi hien nut edit ,delete , con neu category thi hien nut edit delete
        $buttonInArea = config('utils.config.button');
        $controllerName = (array_key_exists ($controllerName, $buttonInArea)) ? $controllerName : 'default';

        $xhtml = '<div class="zvn-box-btn-filter">';
        $listButton = $buttonInArea[$controllerName];//['edit','delete']
        foreach ($listButton as $btn) {
            $currentButton = $tmplButton[$btn];
            $link = route ($controllerName.$currentButton['route-name'], ['id' => $id]);
            $xhtml .= sprintf ('<a href="%s" type="button" class="btn btn-icon %s" data-toggle="tooltip"
                                      data-placement="top" data-original-title="%s">
                                      <i class="fa %s"></i>
                                      </a>', $link, $currentButton['class'], $currentButton['title'], $currentButton['icon']);
        }
        $xhtml .= '</div>';
        return $xhtml;
    }

}
