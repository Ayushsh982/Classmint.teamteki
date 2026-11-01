<?php

namespace WPDataAccess\WPDA_Navi {

    use WPDataAccess\WPDA;

    class WPDA_Navi {

		public function show() {
			?>
			<div class="wpda-navi-container">
				<?php
				$this->header();
				$this->tool_guide();
				?>
			</div>
			<?php
		}

		private function header() {
            ?>
			<div class="wpda-navi-container-header">
				<div class="wpda-navi-container-header-title">
					<div>
						<h1>
							Welcome to WP Data Access
						</h1>

						<h2>
                            A powerful data-driven App Builder with an intuitive Table Builder, a highly customizable Form Builder and interactive Chart support in 35 languages
						</h2>
					</div>

					<div></div>
				</div>

				<div class="wpda-navi-container-header-image">
					<img src="<?php echo esc_attr( plugins_url('../../assets/images/coding-isometric-01-blauw.png', __FILE__ ) ); ?>" alt="laptop" />
				</div>
			</div>
			<?php
			WPDA::load_wp_tables();
		}

		private function tool_guide() {
			?>
            <div class="wpda-navi-container-content"
                 style="display: grid; grid-template-columns: auto auto; justify-content: space-between; align-items: center; padding-bottom: 0;"
            >
                <h2>
                    Tool Guide
                </h2>
            </div>

			<div class="wpda-navi-container-content">
				<div class="wpda-navi-container-content-items">
					<div class="wpda-navi-container-content-item wpda-featured">
						<div class="wpda-navi-container-content-item-title">
							<span class="fa-solid wpda-icon">
								<svg xmlns="http://www.w3.org/2000/svg"
									 height="18px"
									 width="18px"
									 viewBox="4 4 16 16"
									 fill="inherit"
									 class="wpda-icon"
								>
									<path d="M4 8h4V4H4v4zm6 12h4v-4h-4v4zm-6 0h4v-4H4v4zm0-6h4v-4H4v4zm6 0h4v-4h-4v4zm6-10v4h4V4h-4zm-6 4h4V4h-4v4zm6 6h4v-4h-4v4zm0 6h4v-4h-4v4z"></path>
								</svg>
							</span>
							<h3>App Builder</h3>
							<div class="wpda-navi-container-content-item-title-help">
								<a
										href="https://docs.rad.wpdataaccess.com/"
										target="_blank"
										class="wpda_tooltip"
										title="View online App Builder documentation"
								>
									<i class="fa-solid fa-question-circle wpda-icon-help"></i>
								</a>
							</div>
						</div>

						<div class="wpda-navi-container-content-item-slogan" style="display: flex; justify-content: space-between; align-items: center;">
                            <span>
                                A data-driven Rapid Application Development tool.
                            </span>

                            <span></span>
						</div>

						<div class="wpda-navi-container-content-item-content">
							<ul class="wpda-navi-container-content-item-content-grid switch-grid">
								<li>
									<a href="?page=wpda_apps">Start App Builder</a>
								</li>
								<li>
									<a href="?page=wpda_apps&page_iaction=create_new_app">Create a new app</a>
								</li>
							</ul>
						</div>

                        <div class="wpda-navi-container-content-item-facts">
                            <ul>
                                <li><strong>Table Builder</strong> – Create powerful data tables.</li>
                                <li><strong>Form Builder</strong> – Design data entry forms.</li>
                                <li><strong>Chart Builder</strong> – Visualize data.</li>
                                <li><strong>Map Builder</strong> – Plot location data.</li>
                                <li><strong>Dashboard Builder</strong> – Centralize and monitor insights.</li>
                                <li><strong>Theme Builder</strong> – Personalize app appearance.</li>
                            </ul>
                        </div>
					</div>

					<div class="wpda-navi-container-content-item">
						<div class="wpda-navi-container-content-item-title">
							<span class="fa-solid fa-database wpda-icon"></span>
							<h3>Explorer</h3>
							<div class="wpda-navi-container-content-item-title-help">
								<a
										href="https://docs.explorer.wpdataaccess.com/"
										target="_blank"
										class="wpda_tooltip"
										title="View online Data Explorer documentation"
								>
									<i class="fa-solid fa-question-circle wpda-icon-help"></i>
								</a>
							</div>
						</div>

						<div class="wpda-navi-container-content-item-slogan">
							Perform data and database related tasks.
						</div>

						<div class="wpda-navi-container-content-item-content">
							<ul class="wpda-navi-container-content-item-content-grid">
								<li>
									<a href="?page=wpda">Start Data Explorer</a>
								</li>
								<li>
									<a href="?page=wpda&page_iaction=wpda_import_sql">Import SQL files</a>
								</li>
								<li>
									<a href="?page=wpda&page_iaction=manage_databases">Manage databases</a>
								</li>
								<li>
									<a href="?page=wpda&page_action=wpda_import_csv">Import CSV files</a>
								</li>
							</ul>
						</div>

						<div class="wpda-navi-container-content-item-facts">
							<ul>
                                <li>Schedule unattended exports (new Data Explorer only).</li>
                                <li>Manage database connections, databases and table data.</li>
								<li>Explore local and remote databases.</li>
                                <li>Global search and replace.</li>
							</ul>
						</div>

                        <div class="wpda-navi-container-content-item-facts">
                            <ul>
                                <li>
                                    Old Data Explorer no longer available.
                                </li>
                            </ul>
                        </div>
					</div>

					<div class="wpda-navi-container-content-item">
						<div class="wpda-navi-container-content-item-title">
							<span class="fa-solid fa-code wpda-icon"></span>
							<h3>SQL</h3>
							<div class="wpda-navi-container-content-item-title-help">
								<a
										href="https://docs.sql.wpdataaccess.com/"
										target="_blank"
										class="wpda_tooltip"
										title="View online SQL Query Builder Documentation"
								>
									<i class="fa-solid fa-question-circle wpda-icon-help"></i>
								</a>
							</div>
						</div>

						<div class="wpda-navi-container-content-item-slogan">
							Execute any SQL command from your WordPress dashboard.
						</div>

						<div class="wpda-navi-container-content-item-content">
							<ul>
								<li>
									<a href="?page=wpda_query_builder">Start SQL Query Builder</a>
								</li>
							</ul>
						</div>

						<div class="wpda-navi-container-content-item-facts">
							<ul>
								<li>Write, store, execute and reuse any SQL command.</li>
                                <li>Store queries privately or globally.</li>
                                <li>Schedule SQL commands to run at specific intervals.</li>
								<li>Ask AI Assistant to help writing queries and solve errors.</li>
                                <li>Build SQL queries visually with our Visual Query Builder.</li>
                            </ul>
						</div>

                        <div class="wpda-navi-container-content-item-facts">
                            <ul>
                                <li>
                                    Old SQL Query Builder no longer available.
                                </li>
                            </ul>
                        </div>
					</div>

					<div class="wpda-navi-container-content-item wpda-featured"
						 style="grid-template-rows: auto 1fr"
					>
						<div class="wpda-navi-container-content-item-title">
							<span class="fa-solid fa-comments wpda-icon"></span>
							<h3>What's new?</h3>
							<div class="wpda-navi-container-content-item-title-help">
								<a
										href="https://wordpress.org/plugins/wp-data-access/#developers"
										target="_blank"
										class="wpda_tooltip"
										title="View full changelog"
								>
									<i class="fa-solid fa-question-circle wpda-icon-help"></i>
								</a>
							</div>
						</div>

						<div class="wpda-navi-container-content-item-facts whats-new">
							<ul>
                                <li>
                                    <a href="https://docs.legacy.wpdataaccess.com/docs/from-legacy-to-apps/"
                                       target="_blank"
                                       class="wpda_tooltip whatsnew"
                                       title="Contact us if you need assistance"
                                    >
                                        Removed legacy tool activation and deactivation.
                                    </a>
                                </li>
                                <li>
                                    <a href="?page=wpda_navi-affiliation" class="whatsnew">
                                        ⭐⭐⭐ Affiliates Program ⭐⭐⭐<br/>Become our ambassador and earn on every referral.
                                    </a>
                                </li>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/table-builder/menu/table/bulk-actions.html#predefined-pdf-export" target="_blank" class="whatsnew">
                                        Creating predefined PDF table exports.
                                    </a>
                                </li>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/app-manager/running-apps/progressive-web-apps.html" target="_blank" class="whatsnew">
                                        Run a WP Data Access app as a Progressive Web App.
                                    </a>
                                </li>
								<li>
									<a href="https://docs.rad.wpdataaccess.com/running-apps.html#%E2%9C%8F%EF%B8%8F-using-the-gutenberg-block-editor" target="_blank" class="whatsnew">
										Gutenberg block support for [wpda_app] shortcode.
									</a>
								</li>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/table-builder/menu/table/column-filters.html" target="_blank" class="whatsnew">
                                        Show column filters in popup.
                                    </a>
                                </li>
							</ul>
						</div>

                        <div class="wpda-navi-container-content-item-facts whats-new">
                            <h4 style="margin-top:0;margin-bottom:5px;font-weight:bold;">Now available to FREE USERS</h4>
                            <ul>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/table-builder/menu/table/css-table-editor.html" target="_blank" class="whatsnew">
                                        CSS Table Editor
                                    </a>
                                </li>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/form-builder/menu/form/css-form-editor.html" target="_blank" class="whatsnew">
                                        CSS Form Editor
                                    </a>
                                </li>
                                <li>
                                    <a href="https://docs.rad.wpdataaccess.com/table-builder/menu/columns/computed-fields.html" target="_blank" class="whatsnew">
                                        Computed Text Fields
                                    </a>
                                </li>
                                <li>
                                    <a href="https://docs.sql.wpdataaccess.com/visual-query-builder.html" target="_blank" class="whatsnew">
                                        Visual Query Builder
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
				</div>
			</div>
			<?php
		}

	}

}