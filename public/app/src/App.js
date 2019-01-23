import DefaultLayout from '@/components/layout/DefaultLayout'

export default {
  name: 'App',
  render () {
    let { singlePage = false } = this.$route.meta
    let layout = singlePage
      ? <router-view/>
      : <DefaultLayout><router-view/></DefaultLayout>
    return (
      <div id="app">
        {layout}
      </div>
    )
  }
}
