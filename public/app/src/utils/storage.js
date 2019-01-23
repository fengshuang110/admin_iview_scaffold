import localforage from 'localforage'

localforage.config({
  driver: localforage.LOCALSTORAGE,
  name: '_app'
})

export const KEY_CURRENT_GAME = 'currentGame'

export default {
  get (key) {
    return localforage.getItem(key)
  },
  set (key, val) {
    return localforage.setItem(key, val)
  },
  async remove (key) {
    return localforage.removeItem(key)
  }
}
