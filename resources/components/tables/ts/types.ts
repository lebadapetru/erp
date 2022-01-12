export interface TableColumnInterface {
  name: string,
  key: string,
  width?: number,
  fieldParser: (any: any) => any,
}

export interface TableActionInterface {
  name: string,
  dispatchAction: (any: any) => void
}

export interface StatusBadgeInterface {
  label: string,
  value: any,
}