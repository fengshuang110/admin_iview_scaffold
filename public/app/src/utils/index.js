export default {
  /**
   * 浅度比较两个对面的不同
   */
  objectDiff (newObj, oldObj, omits = ['id']) {
    let result = {}
    for (let key in newObj) {
      if (newObj[key] === oldObj[key] && !omits.includes(key)) {
        continue
      }
      result[key] = newObj[key]
    }
    return result
  },

  /**
   * 导航面包屑
   */
  breadCrumb (groupMenus, path) {
    if (groupMenus.length < 1) {
      return {}
    }

    let breads = [{
      name: '首页',
      link: '/'
    }]
    let parent = {
      name: '',
      link: ''
    }
    // /a/b/c => /a/b
    let pathSplit = path.split('/')
    path = `/${pathSplit[1]}/${pathSplit[2]}`
    let current = {}
    for (let i = 0; i < groupMenus.length; i++) {
      let group = groupMenus[i]
      let { menus } = group
      for (let key in menus) {
        let { name, link } = menus[key]
        if (link === path) {
          parent.name = group.name
          current.name = name
          current.link = link
          break
        }
      }
    }

    breads.push(parent)
    breads.push(current)
    return breads
  }
}
