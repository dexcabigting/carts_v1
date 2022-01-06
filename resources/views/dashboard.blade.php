<x-app-layout>
<div class="lg:pt-10 h-auto w-full mt-12 xl:pl-56 xl:mx-12 2xl:mx-56 2xl:pl-44">
<div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3 py-12">
              <!-- Bar chart card -->
              <div class="col-span-2 bg-custom-gray rounded-md dark:bg-darker" x-data="{ isOn: false }">
                <!-- Card header -->
                <div class="flex items-center justify-between p-4  dark:border-primary">
                  <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Bar Chart</h4>
                  <div class="flex items-center space-x-2">
                    <span class="text-sm text-gray-500 dark:text-light">Last year</span>
                    <button class="relative focus:outline-none" x-cloak
                      @click="isOn = !isOn; $parent.updateBarChart(isOn)">
                      <div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                      </div>
                      <div
                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                        :class="{ 'translate-x-0  bg-custom-violet dark:bg-primary-100': !isOn, 'translate-x-6 bg-white dark:bg-primary': isOn }">
                      </div>
                    </button>
                  </div>
                </div>
                <!-- Chart -->
                <div class="relative p-4 h-72">
                  <canvas id="barChart"></canvas>
                </div>
              </div>

              <!-- Doughnut chart card -->
              <div class="bg-custom-gray rounded-md dark:bg-darker" x-data="{ isOn: false }">
                <!-- Card header -->
                <div class="flex items-center justify-between p-4 dark:border-primary">
                  <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Doughnut Chart</h4>
                  <div class="flex items-center">
                    <button class="relative focus:outline-none" x-cloak
                      @click="isOn = !isOn; $parent.updateDoughnutChart(isOn)">
                      <div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                      </div>
                      <div
                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                        :class="{ 'translate-x-0  bg-custom-violet dark:bg-primary-100': !isOn, 'translate-x-6 bg-white dark:bg-primary': isOn }">
                      </div>
                    </button>
                  </div>
                </div>
                <!-- Chart -->
                <div class="relative p-4 h-72">
                  <canvas width="500" id="doughnutChart"></canvas>
                </div>
              </div>
            </div>

            <!-- Two grid columns -->
            <div class="grid grid-cols-1 p-4 space-y-8 lg:gap-8 lg:space-y-0 lg:grid-cols-3">
              <!-- Active users chart -->
              <div class="col-span-1 bg-custom-gray rounded-md dark:bg-darker">
                <!-- Card header -->
                <div class="p-4  dark:border-primary">
                  <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Active users right now</h4>
                </div>
                <p class="p-4">
                  <span class="text-2xl font-medium text-gray-500 dark:text-light" id="usersCount">0</span>
                  <span class="text-sm font-medium text-gray-500 dark:text-primary">Users</span>
                </p>
                <!-- Chart -->
                <div class="relative p-4">
                  <canvas id="activeUsersChart"></canvas>
                </div>
              </div>

              <!-- Line chart card -->
              <div class="col-span-2 bg-custom-gray rounded-md dark:bg-darker" x-data="{ isOn: false }">
                <!-- Card header -->
                <div class="flex items-center justify-between p-4  dark:border-primary">
                  <h4 class="text-lg font-semibold text-gray-500 dark:text-light">Line Chart</h4>
                  <div class="flex items-center">
                    <button class="relative focus:outline-none" x-cloak
                      @click="isOn = !isOn; $parent.updateLineChart()">
                      <div class="w-12 h-6 transition rounded-full outline-none bg-primary-100 dark:bg-primary-darker">
                      </div>
                      <div
                        class="absolute top-0 left-0 inline-flex items-center justify-center w-6 h-6 transition-all duration-200 ease-in-out transform scale-110 rounded-full shadow-sm"
                        :class="{ 'translate-x-0  bg-custom-violet dark:bg-primary-100': !isOn, 'translate-x-6 bg-white dark:bg-primary': isOn }">
                      </div>
                    </button>
                  </div>
                </div>
                <!-- Chart -->
                <div class="relative p-4 h-72">
                  <canvas id="lineChart"></canvas>
                </div>
              </div>
            </div>
          </div>
        </main>

        <!-- Main footer -->
        
      </div>
      </div>
      <!-- Panels -->

      
   

      
    
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.bundle.min.js"></script>
  <script src="js/script.js"></script>
  <script>
    const setup = () => {
      const getTheme = () => {
        if (window.localStorage.getItem('dark')) {
          return JSON.parse(window.localStorage.getItem('dark'))
        }

        return !!window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches
      }

      const setTheme = (value) => {
        window.localStorage.setItem('dark', value)
      }

      const getColor = () => {
        if (window.localStorage.getItem('color')) {
          return window.localStorage.getItem('color')
        }
        return 'cyan'
      }

      const setColors = (color) => {
        const root = document.documentElement
        root.style.setProperty('--color-primary', `var(--color-${color})`)
        root.style.setProperty('--color-primary-50', `var(--color-${color}-50)`)
        root.style.setProperty('--color-primary-100', `var(--color-${color}-100)`)
        root.style.setProperty('--color-primary-light', `var(--color-${color}-light)`)
        root.style.setProperty('--color-primary-lighter', `var(--color-${color}-lighter)`)
        root.style.setProperty('--color-primary-dark', `var(--color-${color}-dark)`)
        root.style.setProperty('--color-primary-darker', `var(--color-${color}-darker)`)
        this.selectedColor = color
        window.localStorage.setItem('color', color)
        //
      }

      const updateBarChart = (on) => {
        const data = {
          data: randomData(),
          backgroundColor: 'rgb(207, 250, 254)',
        }
        if (on) {
          barChart.data.datasets.push(data)
          barChart.update()
        } else {
          barChart.data.datasets.splice(1)
          barChart.update()
        }
      }

      const updateDoughnutChart = (on) => {
        const data = random()
        const color = 'rgb(207, 250, 254)'
        if (on) {
          doughnutChart.data.labels.unshift('Seb')
          doughnutChart.data.datasets[0].data.unshift(data)
          doughnutChart.data.datasets[0].backgroundColor.unshift(color)
          doughnutChart.update()
        } else {
          doughnutChart.data.labels.splice(0, 1)
          doughnutChart.data.datasets[0].data.splice(0, 1)
          doughnutChart.data.datasets[0].backgroundColor.splice(0, 1)
          doughnutChart.update()
        }
      }

      const updateLineChart = () => {
        lineChart.data.datasets[0].data.reverse()
        lineChart.update()
      }

      return {
        loading: true,
        isDark: getTheme(),
        toggleTheme() {
          this.isDark = !this.isDark
          setTheme(this.isDark)
        },
        setLightTheme() {
          this.isDark = false
          setTheme(this.isDark)
        },
        setDarkTheme() {
          this.isDark = true
          setTheme(this.isDark)
        },
        color: getColor(),
        selectedColor: 'cyan',
        setColors,
        toggleSidbarMenu() {
          this.isSidebarOpen = !this.isSidebarOpen
        },
        isSettingsPanelOpen: false,
        openSettingsPanel() {
          this.isSettingsPanelOpen = true
          this.$nextTick(() => {
            this.$refs.settingsPanel.focus()
          })
        },
        isNotificationsPanelOpen: false,
        openNotificationsPanel() {
          this.isNotificationsPanelOpen = true
          this.$nextTick(() => {
            this.$refs.notificationsPanel.focus()
          })
        },
        isSearchPanelOpen: false,
        openSearchPanel() {
          this.isSearchPanelOpen = true
          this.$nextTick(() => {
            this.$refs.searchInput.focus()
          })
        },
        isMobileSubMenuOpen: false,
        openMobileSubMenu() {
          this.isMobileSubMenuOpen = true
          this.$nextTick(() => {
            this.$refs.mobileSubMenu.focus()
          })
        },
        isMobileMainMenuOpen: false,
        openMobileMainMenu() {
          this.isMobileMainMenuOpen = true
          this.$nextTick(() => {
            this.$refs.mobileMainMenu.focus()
          })
        },
        updateBarChart,
        updateDoughnutChart,
        updateLineChart,
      }
    }
  </script>
</x-app-layout>
