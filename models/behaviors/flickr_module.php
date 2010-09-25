<?php

class FlickrModuleBehavior extends ModelBehavior {

    public function setup(&$model, $config = array()) {
        if (is_string($config)) {
            $config = array($config);
        }

        $this->settings[$model->alias] = $config;
    }

    public function afterFind(&$model, $results = array(), $primary = false) {
        if ($primary && isset($results[0][$model->alias])) {
            foreach ($results AS $i => $result) {
                if (isset($results[$i][$model->alias]['body'])) {
                    $results[$i][$model->alias]['body'] .= '<p>[Modified by ExampleBehavior]</p>';
                }
            }
        } elseif (isset($results[$model->alias])) {
            if (isset($results[$model->alias]['body'])) {
                $results[$model->alias]['body'] .= '<p>[Modified by ExampleBehavior]</p>';
            }
        }

        return $results;
    }

}
?>