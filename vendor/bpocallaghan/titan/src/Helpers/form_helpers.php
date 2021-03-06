<?php

if (!function_exists('form_error_class')) {
    function form_error_class($attribute, $errors)
    {
        return $errors->first($attribute, 'has-error');
    }
}

if (!function_exists('form_error_message')) {
    function form_error_message($attribute, $errors)
    {
        return $errors->first($attribute,
            '<i><small for="' . $attribute . '" class="text-red">:message</small></i>');
    }
}

if (!function_exists('action_row')) {
    /**
     * Get the html for the actions for a table list
     * @param            $url
     * @param            $id
     * @param            $title
     * @param array      $actions
     * @param bool       $wrapButtons
     * @return string
     */
    function action_row(
        $url,
        $id,
        $title,
        $actions = ['show', 'edit', 'delete', 'copy', 'forceDelete', 'restore'],
        $wrapButtons = true
    ) {
        $url = rtrim($url, '/') . '/'; // remove last / and add it again (if it was not there)

        $show = '<div class="btn-group">
                    <a href="' . $url . $id . '" class="btn btn-default btn-sm" data-toggle="tooltip" title="Voir ' . $title . '">
                        <i class="fa fa-eye"></i>
                    </a>
                </div>';

        $edit = '<div class="btn-group">
                    <a href="' . $url . $id . '/edit' . '" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Modifier ' . $title . '">
                        <i class="fa fa-edit"></i>
                    </a>
                </div>';

        $delete = '<div class="btn-group">
                        <form id="form-delete-row' . $id . '" method="POST" action="' . $url . $id . '">
                        <input name="_method" type="hidden" value="DELETE">
                        <input name="_token" type="hidden" value="' . csrf_token() . '">
                        <input name="_id" type="hidden" value="' . $id . '">
                        <a data-form="form-delete-row' . $id . '" class="btn btn-danger btn-sm btn-delete-row" data-toggle="tooltip" title="Supprimer ' . $title . '">
                            <i class="fa fa-trash"></i>
                        </a>
                        </form>
                    </div>';

// AJOUTS

        $copy = '<div class="btn-group">
						<a href="' . $url . $id . '/copy-item' . '" class="btn btn-success btn-sm" data-toggle="tooltip" title="Dupliquer ' . $title . '">
							<i class="fa fa-copy"></i>
						</a>
					</div>';
		
        $forceDelete = '<div class="btn-group">
							<form id="form-delete-row' . $id . '" method="POST" action="' . $url . $id . '/force-delete">
							<input name="_token" type="hidden" value="' . csrf_token() . '">
							<input name="_id" type="hidden" value="' . $id . '">
							<a data-form="form-delete-row' . $id . '" class="btn btn-danger btn-sm btn-delete-row" data-toggle="tooltip" title="Supprimer définitivement ' . $title . ' et les médias associés">
								<i class="fa fa-trash"></i>
							</a>
							</form>
						</div>';

        $restore = '<div class="btn-group">
						<a href="' . $url . $id . '/restore' . '" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Restaurer ' . $title . '">
							<i class="fa fa-recycle"></i>
						</a>
					</div>';
		
        $html = '';
        foreach ($actions as $k => $action) {
            if ($action == 'show') {
                $html .= $show;
            }
            if ($action == 'edit') {
                $html .= $edit;
            }
            if ($action == 'delete') {
                $html .= $delete;
            }
            if ($action == 'copy') {
                $html .= $copy;
            }
            if ($action == 'forceDelete') {
                $html .= $forceDelete;
            }
            if ($action == 'restore') {
                $html .= $restore;
            }

            if (is_array($action)) {
                $key = key($action);
                $urll = $action[$key];

                $html .= '<div class="btn-group">
                    <a href="' . $urll . '" class="btn btn-primary btn-sm" data-toggle="tooltip" title="Voir ' . $key . ' pour ' . $title . '">
                        <i class="fa fa-' . $key . '"></i>
                    </a>
                </div>';
            }
        }

        if (!$wrapButtons) {
            return $html;
        }

        return '<div class="btn-toolbar">' . $html . '</div>';
    }
}

if (!function_exists('form_select')) {

    function select_option($display, $value, $selected)
    {
        $selected = select_selected($value, $selected);

        $options = ['value' => $value, 'selected' => $selected];

        return '<option' . select_attributes($options) . '>' . ($display) . '</option>';
    }

    function select_selected($value, $selected)
    {
        if (is_array($selected)) {
            return in_array($value, $selected) ? 'selected' : null;
        }

        return ((string) $value == (string) $selected) ? 'selected' : null;
    }

    function select_attributes($attributes)
    {
        $html = [];

        foreach ((array) $attributes as $key => $value) {
            $element = select_attribute_element($key, $value);

            if (!is_null($element)) {
                $html[] = $element;
            }
        }

        return count($html) > 0 ? ' ' . implode(' ', $html) : '';
    }

    function select_attribute_element($key, $value)
    {
        if (is_numeric($key)) {
            $key = $value;
        }

        if (!is_null($value)) {
            return $key . '="' . e($value) . '"';
        }
    }

    /**
     * Simple form select options
     * @param $name
     * @param $list
     * @param $selected
     * @param $options
     * @return string
     */
    function form_select($name, $list, $selected, $options)
    {
        $options['id'] = $name;

        if (!isset($options['name'])) {
            $options['name'] = $name;
        }

        $html = [];
        foreach ($list as $value => $display) {
            $html[] = select_option($display, $value, $selected);
        }

        // Once we have all of this HTML, we can join this into a single element after
        // formatting the attributes into an HTML "attributes" string, then we will
        // build out a final select statement, which will contain all the values.
        $options = select_attributes($options);

        $list = implode('', $html);

        return "<select{$options}>{$list}</select>";
    }
}
